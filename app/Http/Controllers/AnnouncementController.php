<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
class AnnouncementController extends Controller
{

    public $title = 'Announcement';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $announcements = Announcement::orderBy('created_at','DESC')->get();
        return view('announcement.index',compact('announcements'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('announcement.create')->with('title',$this->title);
    }

    public function search()
    {
        $data = request()->validate(['data'=>'required']);

        $announcements = Announcement::where(function ($query) use($data) {
            $query->where('title', 'like', '%'.$data['data'].'%');
                  
        })->paginate(4);
        $announcements =  $announcements->appends(array ('data' => $data['data']));
        return view('announcement.index',compact('announcements'))->with('title',$this->title)->with('btn',true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title'=>'required',
            'body'=>'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        
        //handle file uploading
        if($request->hasFile('cover_image')){
           
           if($request->file('cover_image') != 'uploads/noimage.png'){

           		$file = $request->file('cover_image');

           		$imageName = 'uploads/' . time() .'_'. $file->getClientOriginalName();
         
                Storage::disk('s3')->put($imageName,file_get_contents($file),'public');
          
                $pathToSave = $imageName;
           }

        }else{
            $pathToSave = 'uploads/noimage.png';
        }

        // Save filename to database
        $data['cover_image'] = $pathToSave;
        // Add the author
        $data['user_id'] = auth()->user()->id;
        $status = Announcement::create($data);

        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record added successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = Announcement::findOrfail($id);

        if ($status){
            return response()->json([
                'status' => 'success',
                'title' => $status->title,
                'body' => $status->body,
                'cover_image' => $status->cover_image
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $announcement = Announcement::findOrfail($id);
        $data = request()->validate([
            'title'=>'required',
            'body'=>'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //handle file uploading
        if($request->hasFile('cover_image')){
            if($request->file('cover_image') != 'uploads/noimage.png'){
                // finds the old image and delete
                Storage::disk('s3')->delete($announcement->cover_image);
            }

            // upload new image
            $path = request()->file('cover_image');
            $pathToSave = Storage::disk('s3')->put('uploads',$path,'public');

            // Save filename to database
            $data['cover_image'] = $pathToSave;
        }
        
        $status = $announcement->update($data);

        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record updated successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record s'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = Announcement::findOrfail($id);
        if($announcement->cover_image != 'uploads/noimage.png'){
            // Delete image
            Storage::disk('s3')->delete($announcement->cover_image);
        }

        $status = $announcement->delete();
        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record deleted successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }
}

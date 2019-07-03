<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $announcements = Announcement::orderBy('created_at','DESC')->paginate(4);
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
        return view('announcement.index',compact('announcements'))->with('title',$this->title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(['title'=>'required','body'=>'required']);
        $data['user_id'] = auth()->user()->id;
        Announcement::create($data);

        return redirect('dashboard/announcement')->with('success','Successfully Added!');
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
    public function edit(Announcement $announcement)
    {
        return view('announcement.edit',compact('announcement'))->with('title',$this->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        $data = request()->validate([
            'title'=>'required',
            'body'=>'required'

        ]);

        $announcement->update($data);

        return redirect('dashboard/announcement')->with('success','Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect('dashboard/announcement')->with('success','Successfully Deleted!');
    }
}

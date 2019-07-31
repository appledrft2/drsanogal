<?php

namespace App\Http\Controllers;

use App\ClientForm;
use App\FormCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientFormController extends Controller
{
    public $title = "Client";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client_id)
    {
        $forms = ClientForm::where('client_id',$client_id)->get();
        $formcategorys = FormCategory::orderBy('created_at','desc')->get();
        return view('clientform.index',compact('forms','client_id','formcategorys'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$client_id)
    {
        $data = request()->validate([
   
            'category'=>'required',
            'file' => 'required|max:3999'
        ]);
        
        //handle file uploading
        if($request->hasFile('file')){
           
     

                $file = $request->file('file');

                $fileName = 'files/' . time() .'_'. $file->getClientOriginalName();
         
                Storage::disk('s3')->put($fileName,file_get_contents($file),'public');
          
                $pathToSave = $fileName;
           

        }

        // Save filename to database
        $data['file'] = $pathToSave;
        // Add the author
        $data['client_id'] = $client_id;
        $status = ClientForm::create($data);

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
     * @param  \App\ClientForm  $clientForm
     * @return \Illuminate\Http\Response
     */
    public function show(ClientForm $clientForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientForm  $clientForm
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientForm $clientForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientForm  $clientForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $clientform = ClientForm::findOrfail($request->id);
        $data = request()->validate([
            'category'=>'required',
        
        ]);

        //handle file uploading
        if($request->hasFile('file')){
        
            // finds the old image and delete
            Storage::disk('s3')->delete($clientform->file);
          

            $file = $request->file('file');

            $fileName = 'files/' . time() .'_'. $file->getClientOriginalName();
     
            Storage::disk('s3')->put($fileName,file_get_contents($file),'public');
      
            $pathToSave = $fileName;

            // Save filename to database
            $data['file'] = $pathToSave;
        }
        
        $status = $clientform->update($data);

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
     * @param  \App\ClientForm  $clientForm
     * @return \Illuminate\Http\Response
     */
    public function destroy($cleint_id,$form_id)
    {
        $clientform = ClientForm::findOrfail($form_id);
        
            // Delete image
            Storage::disk('s3')->delete($clientform->file);
        

        $status = $clientform->delete();

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

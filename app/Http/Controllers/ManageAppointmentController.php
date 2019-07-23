<?php

namespace App\Http\Controllers;

use App\ManageAppointment;
use Illuminate\Http\Request;

class ManageAppointmentController extends Controller
{
   
    public $title = 'Patient';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mas = ManageAppointment::orderBy('created_at','desc')->get();
        return view('manageappointment.index',compact('mas'))->with('title',$this->title);
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);

        $status = ManageAppointment::create($data);

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
     * @param  \App\ManageAppointment  $ManageAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(ManageAppointment $ManageAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ManageAppointment  $ManageAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = ManageAppointment::findOrfail($id);

        if ($status){
            return response()->json([
                'status' => 'success',
                'title' => $status->title,
                'description' => $status->description
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
     * @param  \App\ManageAppointment  $ManageAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $status = ManageAppointment::findOrfail($id);

       $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);

        $status->update($data);

        if ($status){
            return response()->json([
                'status' => 'success',
                'message' => 'Record updated successfully'
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManageAppointment  $ManageAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = ManageAppointment::findOrfail($id);
        $status->delete();
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

<?php

namespace App\Http\Controllers;

use App\Preventive;
use App\Appointment;
use Illuminate\Http\Request;

class PreventiveController extends Controller
{
    public $title = "Preventive";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($appointment_id)
    {
        $preventives = Preventive::orderBy('created_at','desc')->paginate(5);
        $appointment = Appointment::findOrfail($appointment_id);
        return view('preventive.index',
            ['preventives' => $preventives,
            'appointment'=>$appointment]
        )->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($appointment)
    {
        return view('preventive.create',compact('appointment'))->with('title',$this->title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($appointment,Request $request)
    {
         $data = $request->validate([
            'time' => 'required',
            'kg' => 'required',
            'temp' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        $data['appointment_id'] = $appointment;
        $data['status'] = 'Unpaid';

        Preventive::create($data);
        toast('Successfully added!','success');
        return redirect('dashboard/appointment/'.$appointment.'/preventive')->with('title',$this->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Preventive  $preventive
     * @return \Illuminate\Http\Response
     */
    public function show($appointment,Preventive $preventive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Preventive  $preventive
     * @return \Illuminate\Http\Response
     */
    public function edit($appointment,Preventive $preventive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Preventive  $preventive
     * @return \Illuminate\Http\Response
     */
    public function update($appointment,Request $request, Preventive $preventive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Preventive  $preventive
     * @return \Illuminate\Http\Response
     */
    public function destroy($appointment,Preventive $preventive)
    {
        //
    }
}

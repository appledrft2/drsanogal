<?php

namespace App\Http\Controllers;

use App\Preventive;
use App\Appointment;
use Illuminate\Http\Request;

class PreventiveController extends Controller
{
    public $title = "Patient";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($appointment_id)
    {
        $preventives = Preventive::orderBy('created_at','desc')->get();
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

        public function search($appointment)
    {
        $data = request()->validate(['data'=>'required']);

        $preventives = Appointment::findOrfail($appointment)->preventives()->where(function ($query) use($data) {
            $query->where('time', 'like', '%'.$data['data'].'%')
                  ->orWhere('description', 'like', '%'.$data['data'].'%')
                  ->orWhere('kg', 'like', '%'.$data['data'].'%')
                  ->orWhere('temp', 'like', '%'.$data['data'].'%')
                  ->orWhere('status', 'like', '%'.$data['data'].'%')
                  ->orWhere('price','like','%'.$data['data'].'%');
        })->paginate(4);
        $preventives =  $preventives->appends(array ('data' => $data['data']));
        $appointment = Appointment::findOrfail($appointment);
        return view('preventive.index',['preventives'=>$preventives,'appointment'=>$appointment])->with('title',$this->title)->with('btn',true);
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
            'type' => 'required',
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
        return redirect('dashboard/appointment/'.$appointment.'/detail')->with('title',$this->title);
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
    public function edit($appointment,Preventive $preventive,$id)
    {
        $preventive = Preventive::findOrfail($id);
        return view('preventive.edit',['preventive'=>$preventive,'appointment'=>$appointment])->with('title',$this->title);
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
       $data = $request->validate([
                    'type' => 'required',
                    'description' => 'required',
                    'time' => 'required',
                    'kg' => 'required',
                    'temp' => 'required',
                    'price' => 'required'
                ]);

        $preventive->update($data);

        toast('Record successfully updated!','success');
        return redirect('dashboard/appointment/'.$appointment.'/preventive');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Preventive  $preventive
     * @return \Illuminate\Http\Response
     */
    public function destroy($appointment,Preventive $preventive,$id)
    {   $preventive = Preventive::findOrfail($id);
        $preventive->delete();
        toast('Record has been deleted!','error');
        return redirect('dashboard/appointment/'.$appointment.'/detail');
    }
}

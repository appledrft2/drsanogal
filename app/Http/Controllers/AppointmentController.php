<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public $title = 'Patient';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient)
    {
       $appointments = Patient::findOrfail($patient)->appointments()->orderBy('created_at','desc')->paginate(4);
       $patient = Patient::findOrfail($patient);
       return view('appointment.index',['appointments'=>$appointments,'patient'=>$patient])->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient)
    {
        return view('appointment.create',compact('patient'))->with('title',$this->title);
    }

    public function search($patient)
    {
        $data = request()->validate(['data'=>'required']);

        $appointments = Patient::findOrfail($patient)->appointments()->where(function ($query) use($data) {
            $query->where('id', 'like', '%'.$data['data'].'%')
                  ->orWhere('description', 'like', '%'.$data['data'].'%')
                  ->orWhere('date_from', 'like', '%'.$data['data'].'%')
                  ->orWhere('date_to', 'like', '%'.$data['data'].'%')
                  ->orWhere('status','like','%'.$data['data'].'%');
        })->paginate(4);
        $appointments =  $appointments->appends(array ('data' => $data['data']));
        $patient = patient::findOrfail($patient);
        return view('appointment.index',['appointments'=>$appointments,'patient'=>$patient])->with('title',$this->title)->with('btn',true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($patient,Request $request)
    {
        $data = $request->validate([
            'date_from' => 'required',
            'date_to' => 'required',
            'description' => 'required',
        ]);

        $data['patient_id'] = $patient;
        $data['isNotified'] = 0;
        $data['status'] = '';

        Appointment::create($data);
        toast('Successfully added!','success');
        return redirect('dashboard/patient/'.$patient.'/appointment')->with('title',$this->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($patient,Appointment $appointment)
    {
         return view('appointment.edit',['patient'=>$patient,'appointment'=>$appointment])->with('title',$this->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update($patient,Request $request, Appointment $appointment)
    {
        $data = $request->validate([
                    'description' => 'required',
                    'date_from' => 'required',
                    'date_to' => 'required',
                ]);

        $appointment->update($data);

        toast('Record successfully updated!','success');
        return redirect('dashboard/patient/'.$patient.'/appointment');
    }

    public function UpdateStatus($patient,Request $request, Appointment $appointment){
        $data = $request->validate([
                    'status' => 'required'
                ]);
        $appointment->update($data);

        toast('Status successfully updated!','success');
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($patient,Appointment $appointment)
    {
        $appointment->delete();
        toast('Record has been deleted!','error');
        return redirect('dashboard/patient/'.$patient.'/appointment');
    }
}

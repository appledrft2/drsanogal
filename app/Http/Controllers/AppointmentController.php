<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Appointment;
use App\ManageAppointment;
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
       $appointments = Patient::findOrfail($patient)->appointments()->orderBy('created_at','desc')->get();
       $patient = Patient::findOrfail($patient);
       $services = ManageAppointment::orderBy('created_at','asc')->get();
       
     
       return view('appointment.index',['appointments'=>$appointments,'patient'=>$patient,'services'=>$services])->with('title',$this->title);
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
        // return $request->all();

        // $data = $request->validate([
        //     'date_from' => 'required',
        //     'date_to' => 'required',
       
        // ]);

        //  $data['description'] = (request()->description) ? request()->description : ' ';

        // $data['patient_id'] = $patient;
        // $data['isNotified'] = 0;
        // $data['status'] = 'Not Completed';

        // Appointment::create($data);
        // toast('Successfully added!','success');
        // return redirect('dashboard/patient/'.$patient.'/appointment')->with('title',$this->title);

        $data = $request->validate([
            'visited' => 'required',
            'time' => 'required',
            'temperature' => 'required',
            'kilogram' => 'required',
            'appointment.*' => 'nullable',
            'appointment.0' => 'required',
            'price.*' => 'nullable',
            'price.0' => 'required',

        ]);
        // $amount = 0;
        // foreach($request->price as $value){
        //     $amount = $amount + $value;
        // }
        // $data['next_appointment'] = date('Y-m-d');
        // $data['amount'] = $amount;
        // $data['patient_id'] = $patient;
        // $data['appointment'] = implode(',', $request->appointment); 
        // $data['price'] = implode(',', $request->price); 
        // $data['description'] = implode(',', $request->description); 
        // if(request()->next_appointment2){
        //     $data['next_appointment2'] = implode(',', $request->next_appointment2); 
        // }else{
        //     $data['next_appointment2'] = '';
        // }

        foreach($request->appointment as $key => $value){
            $data['next_appointment'] = date('Y-m-d');
            $data['patient_id'] = $patient;
            $data['price'] = $request->price[$key];
            $data['amount'] = $request->price[$key];
            $data['appointment'] = $request->appointment[$key];
            $data['next_appointment2'] = $request->next_appointment2[$key];
            $data['appointment'] = $request->appointment[$key];
            $data['description'] = $request->description[$key];
        
        
            $status = Appointment::create($data);

        }

        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Records added successfully'

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
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($patient, Appointment $appointment)
    {
         return view('appointment.edit',['patient'=>$patient,'appointment'=>$appointment])->with('title',$this->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($patient,Appointment $appointment)
    {
        $na = explode(',',$appointment->next_appointment2);
         
         return view('appointment.edit',['patient'=>$patient,'appointment'=>$appointment,'na'=>$na])->with('title',$this->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update($patient,Request $request,$appointment_id)
    {
        // $data = $request->validate([
        //             'date_to' => 'required',
        //             'date_from' => 'required',
        //         ]);

        //  $data['description'] = (request()->description) ? request()->description : ' ';

        // $appointment->update($data);

        // toast('Record successfully updated!','success');
        // return redirect('dashboard/patient/'.$patient.'/appointment');

        $data = $request->validate([
            'visited' => 'required',
            'time' => 'required',
            'next_appointment2' => 'nullable',
            'appointment' => 'required',
            'price' => 'required',
            'temperature' => 'required',
            'kilogram' => 'required',
            'description' => 'nullable'

        ]);

        $data['amount'] = $request->price;

        $appointment =Appointment::findOrfail($appointment_id);
        $status = $appointment->update($data);

        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Records added successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }

    }

    public function UpdateStatus($patient,Request $request, Appointment $appointment){
        $data = $request->validate([
                    'isCompleted' => 'required'
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
        $status = $appointment->delete();
        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Records added successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }
}

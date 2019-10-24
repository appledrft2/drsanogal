<?php

namespace App\Http\Controllers;

use App\Systemlog;
use App\reschedule;
use App\Appointment;
use App\Custom\SmsGateway;
use App\ManageAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentListController extends Controller
{	
	public $title = "Appointments";
    public function index(){
        $services = ManageAppointment::orderBy('created_at','asc')->get();
    	$appointments = Appointment::orderByDesc('next_appointment2')->get();
        $reschedule = Reschedule::latest()->get();
    	return view('appointmentlist.index',compact('appointments','services','reschedule'))->with('title',$this->title);
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
    
    public function UpdatePayment($id){
    	
    	$appointment = Appointment::findOrfail($id);

    	$appointment->isPaid = request()->isPaid;

    	$appointment->update();

    	toast('Payment Successfully Updated!','success');
        return redirect('dashboard/appointmentlist')->with('title',$this->title);
    }

    public function reschedule(Request $request){
        
        $data = $request->validate(['reschedule_date' => 'nullable','prev_date'=>'nullable','appointment_id'=>'nullable']);
        $status = Reschedule::create($data);


        $appointment =Appointment::findOrfail($request->appointment_id);
        $appointment->update(['next_appointment2'=>$request->reschedule_date,'isNotified'=>0]);

        if($appointment->patient->client->smsNotify == 'Mobile'){

            $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU2MzY0MTA2OSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjcxODc4LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.1L8SvVoKmlDqpEqa-_4R90-AwxzLqsIf2C1kaMgkqis";

            $phone_number = $appointment->patient->client->contact;
            $message = "Appointment Reminder from Dr. S & J Veterinary Clinic,\nGood day! Mr/Mrs.".$appointment->patient->client->name.", \nWe would like to inform you that your appointment '".$appointment->appointment."' with ".$appointment->patient->name." was rescheduled to ".$request->reschedule_date." Have a great day! -This is a system generated message.";
            $deviceID = 112412;
            $options = [];

            $smsGateway = new SmsGateway($token);
            $result = $smsGateway->sendMessageToNumber($phone_number, $message, $deviceID, $options);

            
        }

        //logging the activity
        \App\Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role),'activity' =>' Appointment "'.$appointment->appointment.'" with pet '.$appointment->patient->name.' owned by Mr/Mrs. '.$appointment->patient->client->name.' was Rescheduled to "'.$request->reschedule_date.'" from previous date '.$request->prev_date]);

        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Appointment rescheduled successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem rescheduling the record'
            ]);
        }
       
    }

    public function update($appointment_id, Request $request){

        $data = $request->validate([
            'visited' => 'required',
            'time' => 'required',
            'next_appointment2' => 'required',
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
                'message' => 'Records updated successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }

        
    }
}

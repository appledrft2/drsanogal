<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class AppointmentListController extends Controller
{	
	public $title = "Appointment List";
    public function index(){
    	$appointments = Appointment::orderBy('created_at','desc')->get();
    	return view('appointmentlist.index',compact('appointments'))->with('title',$this->title);
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
}

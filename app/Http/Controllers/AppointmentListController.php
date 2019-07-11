<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class AppointmentListController extends Controller
{	
	public $title = "Appointment List";
    public function index(){
    	$appointments = Appointment::orderBy('created_at','desc')->paginate(4);
    	return view('appointmentlist.index',compact('appointments'))->with('title',$this->title);
    }
}

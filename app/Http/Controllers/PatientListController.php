<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientListController extends Controller
{
	public $title = "Patient";

    public function index(){

    	$patients = Patient::orderBy('created_at','DESC')->paginate(4);
    	
    	return view('patientlist.index',compact('patients'))->with('title',$this->title);
    }
}

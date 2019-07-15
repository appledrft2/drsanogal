<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientListController extends Controller
{
	public $title = "Patient";

    public function index(){

    	$patients = Patient::orderBy('created_at','DESC')->get();
    	
    	return view('patientlist.index',compact('patients'))->with('title',$this->title);
    }

    public function search(){
    	$data = request()->validate(['data'=>'required']);

    	$patients = Patient::where(function ($query) use($data) {
    	    $query->where('id', 'like', '%'.$data['data'].'%')
    	          ->orWhere('name', 'like', '%'.$data['data'].'%')
    	          ->orWhere('breed','like','%'.$data['data'].'%')
    	          ->orWhere('gender','like','%'.$data['data'].'%')
    	          ->orWhere('specie','like','%'.$data['data'].'%');
    	})->paginate(4);
    	$patients =  $patients->appends(array ('data' => $data['data']));
    	return view('patientlist.index',compact('patients'))->with('title',$this->title)->with('btn',true);
    }
}

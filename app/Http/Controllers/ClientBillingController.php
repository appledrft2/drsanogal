<?php

namespace App\Http\Controllers;

use App\Client;
use App\Product;
use App\Preventive;
use App\Appointment;
use Illuminate\Http\Request;

class ClientBillingController extends BaseController
{
	public $title = "Client";
    public function index($client_id){
    	$products = Product::orderBy('created_at','desc')->get();
    	$client = Client::findOrfail($client_id);
    	$patients = Client::findOrfail($client_id)->patients()->get();

    	
    	return view('clientbilling.index',compact('client','products','patients'))->with('title',$this->title);
    }
    public function store($client_id){
    	dd(request()->all());
    }
}

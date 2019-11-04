<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class TestingController extends BaseController
{
	public $title = 'testing module';

	public function index(){
		$client = Client::first();
		$patients = Client::findOrfail($client->id)->patients()->get();

		return view('testing.index',compact('client','patients'))->with('title',$this->title);
	}

    
}

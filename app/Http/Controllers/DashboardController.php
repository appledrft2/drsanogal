<?php

namespace App\Http\Controllers;

use App\Client;
use App\Announcement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public $title = "Dashboard";

    public function index(){
    	
    	$announcements = Announcement::count('id');
    	$clients = Client::count('id');

    	return view('dashboard.index',[
    		'title'=>$this->title,
    		'announcements'=>$announcements,
    		'clients'=>$clients
    	]);
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Patient;
use App\Announcement;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
	public $title = "Dashboard";

    public function index(){
    	
    	$announcements = Announcement::count('id');
    	$clients = Client::count('id');
        $users =User::count('id');
        $patients =Patient::count('id');

    	return view('dashboard.index',[
    		'title'=>$this->title,
    		'announcements'=>$announcements,
    		'clients'=>$clients,
            'users'=>$users,
            'patients'=>$patients
    	]);
    }
}

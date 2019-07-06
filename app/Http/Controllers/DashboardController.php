<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Patient;
use App\Product;
use App\Announcement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public $title = "Dashboard";

    public function index(){

        // Low product notification
        $lowproducts = Product::orderBy('quantity','ASC')->limit(5)->get(); 

    	// Boxes
    	$announcements = Announcement::count('id');
    	$clients = Client::count('id');
        $products =Product::count('id');
        $patients =Patient::count('id');

    	return view('dashboard.index',[
    		'title'=>$this->title,
    		'announcements'=>$announcements,
    		'clients'=>$clients,
            'products'=>$products,
            'patients'=>$patients,
            'lowproducts'=>$lowproducts
    	]);
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Patient;
use App\Product;
use App\StockIn;
use App\Appointment;
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

        // Upcomming Appointments
        $appointments = Appointment::where('date_to','=',date('Y-m-d'))->paginate(5);

        foreach($appointments as $appointment){

            if($appointment->date_to == date('Y-m-d')){
                if($appointment->isNotified != 1){
                    $app = Appointment::findOrfail($appointment->id);
                    $app->isNotified = 1;
                    $app->update();
                }
            }
        }

        $stockins = StockIn::orderBy('due','desc')->paginate(4);

    	return view('dashboard.index',[
    		'title'=>$this->title,
    		'announcements'=>$announcements,
    		'clients'=>$clients,
            'products'=>$products,
            'patients'=>$patients,
            'lowproducts'=>$lowproducts,
            'appointments'=> $appointments,
            'stockins' => $stockins
    	]);
    }
}

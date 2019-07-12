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
    	$appointmentscount = Appointment::count('id');
     
    	$clients = Client::count('id');
        $products =Product::count('id');
        $patients =Patient::count('id');

        // Upcomming Appointments
        $appointments = Appointment::where('next_appointment','=',date('Y-m-d'))->paginate(4, ['*'], 'appointments');
        

        foreach($appointments as $appointment){
            // if appointment is today
            if($appointment->date_to == date('Y-m-d')){
                // if appointment is not notified by sms
                if($appointment->isNotified != 1){
                    if($appointment->smsNotify == 'Mobile'){
                        $app = Appointment::findOrfail($appointment->id);
                        $app->isNotified = 1;
                        $app->update();
                    }
                }
            }
        }

        $stockins = StockIn::orderBy('due','desc')->paginate(2);

    	return view('dashboard.index',[
    		'title'=>$this->title,
    		'appointmentscount'=>$appointmentscount,
    		'clients'=>$clients,
            'products'=>$products,
            'patients'=>$patients,
            'lowproducts'=>$lowproducts,
            'appointments'=> $appointments,
            'stockins' => $stockins
    	]);
    }

    public function UpdateStockin($id){
        $stockins = StockIn::findOrfail($id);
        $stockins->status = request()->status;
        $stockins->update();
        toast('Updated Successfully','success');
        return redirect('dashboard')->with('title',$this->title);
    }
}

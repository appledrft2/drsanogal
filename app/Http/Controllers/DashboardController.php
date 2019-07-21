<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Billing;
use App\Patient;
use App\Product;
use App\StockIn;
use App\StockOut;
use Carbon\Carbon;
use App\Appointment;
use App\Announcement;
use App\BillingProduct;
use App\StockOutDetail;
use Illuminate\Http\Request;
use App\Custom\SmsGateway;

class DashboardController extends Controller
{
	public $title = "Dashboard";

    public function index(){

        // Low product notification
        $lowproducts = Product::orderBy('quantity','ASC')->limit(4)->get(); 

    	// Boxes
     	//one day (today)
     	$sales_today =Carbon::now()->subDays(1);
     	// week
     	$sales_week = Carbon::now()->subDays(7);
     	//one month / 30 days
     	$sales_month = Carbon::now()->subDays(30);
     	// query
     	$today1 = StockOutDetail::where('created_at', '>=',$sales_today)->sum('netamount');
     	$today2 = Billing::where('created_at', '>=',$sales_today)->sum('netamount');

     	$today = $today1 + $today2;
     	$week1 = StockOutDetail::where('created_at', '>=', $sales_week)->sum('netamount');
     	$week2 = Billing::where('created_at', '>=', $sales_week)->sum('netamount');
     	$week = $week1 + $week2;

     	$gross1 = StockOut::sum('amount');
     	$gross2 = Billing::sum('amount');
     	$gross = $gross1 + $gross2;
     	$net1 = StockOutDetail::sum('netamount');
     	$net2 = Billing::sum('netamount');
     	$net = $net1 + $net2;




        // Upcomming Appointments
        $appointments = Appointment::where('next_appointment','=',date('Y-m-d'))->paginate(4, ['*'], 'appointments');
        

        foreach($appointments as $appointment){
            // if appointment is today
            if($appointment->next_appointment == date('Y-m-d')){
                // if appointment is not notified by sms
                if($appointment->isNotified != 1){
                    if($appointment->patient->client->smsNotify == 'Mobile'){

                        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU2MzY0MTA2OSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjcxODc4LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.1L8SvVoKmlDqpEqa-_4R90-AwxzLqsIf2C1kaMgkqis";

                        $phone_number = $appointment->patient->client->contact;
                        $message = "Appointment Reminder from Dr. S & J Veterinary Clinic,\nGood day! Mr/Mrs.".$appointment->patient->client->name.", \nWe would like to inform you that your appointment with ".$appointment->patient->name." is today! \nyour pet will be having the following procedures:\n".$appointment->appointment."\nWe appreciate your time and look forward to seeing you later today!";
                        $deviceID = 112412;
                        $options = [];

                        $smsGateway = new SmsGateway($token);
                        $result = $smsGateway->sendMessageToNumber($phone_number, $message, $deviceID, $options);
                     
                        
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
            'gross'=>$gross,
            'net'=>$net,
            'today'=>$today,
            'week'=>$week,
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

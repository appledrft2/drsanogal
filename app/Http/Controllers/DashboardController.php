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
        $lowproducts = Product::where('lowstock','>','quantity')->get(); 

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

     	$gross1 = StockOut::where('created_at','like','%'.date('Y-m').'%')->sum('amount');
     	$gross2 = Billing::where('created_at','like','%'.date('Y-m').'%')->sum('amount');
     	$gross = $gross1 + $gross2;
     	$net1 = StockOutDetail::where('created_at','like','%'.date('Y-m').'%')->sum('netamount');
     	$net2 = Billing::where('created_at','like','%'.date('Y-m').'%')->sum('netamount');
     	$net = $net1 + $net2;



        
       $tom = Carbon::today()->addDays(1)->todatestring();
   
        // today's Appointments
        $appointments = Appointment::where('next_appointment2','=',date('Y-m-d'))->where('isNotified','=',1)->paginate(4, ['*'], 'appointments');
        // tommorow
        $tommorows = Appointment::where('next_appointment2','=',$tom)->where('isNotified','=',0)->paginate(4, ['*'], 'appointments');

        foreach($tommorows as $tommorow){

            if($tommorow->patient->client->smsNotify == 'Mobile'){

                $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU2MzY0MTA2OSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjcxODc4LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.1L8SvVoKmlDqpEqa-_4R90-AwxzLqsIf2C1kaMgkqis";

                $phone_number = $tommorow->patient->client->contact;
                $message = "Appointment Reminder from Dr. S & J Veterinary Clinic,\nGood day! Mr/Mrs.".$tommorow->patient->client->name.", \nWe would like to inform you that your appointment with ".$tommorow->patient->name." is tommorow! \nyour pet will be having the following procedures:\n".$tommorow->appointment.",\n If you wish to reschedule your appointment, please contact this number. thank you! -This is a system generated message.";
                $deviceID = 112412;
                $options = [];

                $smsGateway = new SmsGateway($token);
                $result = $smsGateway->sendMessageToNumber($phone_number, $message, $deviceID, $options);
             
                $app = Appointment::findOrfail($tommorow->id);
                $app->isNotified = 1;
                $app->update();
                
            }
                
        }

        $stockins = StockIn::where('mop','!=','Cash')->orderBy('due','desc')->paginate(2);
        $app = Appointment::where('next_appointment2','=',date('Y-m-d'))->where('isNotified','=',1)->paginate(4, ['*'], 'appointments');
    	return view('dashboard.index',[
    		'title'=>$this->title,
            'gross'=>$gross,
            'net'=>$net,
            'today'=>$today,
            'week'=>$week,
            'lowproducts'=>$lowproducts,
            'appointments'=> $app,
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

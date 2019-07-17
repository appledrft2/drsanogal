<?php

namespace App\Http\Controllers;

use App\Client;
use App\Billing;
use App\Product;
use App\Appointment;
use App\BillingService;
use Illuminate\Http\Request;

class BillingController extends Controller
{
	public $title = "Billing";

	public function index($id){
		$client = Client::findOrfail($id);
		$billings = Billing::where('client_id',$id)->get();
    	return view('billing.index',compact('client','billings'))->with('title',$this->title);
	}

    public function list(){
    	$clients = Client::latest()->get();
    	return view('billing.list',compact('clients'))->with('title',$this->title);
    }

    public function create($id){
    	$client = Client::findOrfail($id);
    	$products = Product::latest()->get();
    	return view('billing.create',compact('client','products'))->with('title',$this->title);
    	
    }

    public function store($id){
    	$data = request()->validate([
    	      'rcode' => 'required',
    	  ]);

    	$data['amount'] = 0;
    	$data['client_id'] = $id;

    	$billing_id = Billing::create($data);
    	$sum = 0;
    	// updating for appointment
    	foreach(request()->appointment as $key => $value){
    		// update the appointment
    	      $appointment = Appointment::findOrfail(request()->hidden_appointment_id[$key]);
    	      $appointment->isPaid = request()->isPaid[$key];
    	      $appointment->update();

    	      if(request()->isPaid[$key] == 1){
    	      	$billingservice = new BillingService();
    	      	$billingservice->billing_id = $billing_id->id;
    	      	$billingservice->appointment = request()->appointment[$key];
    	      	$billingservice->amount = request()->amount[$key];
    	      	$billingservice->save();

    	      	// get the total amount
    	      	$sum = $sum + request()->amount[$key];
    	      }

    	}

    	$udpateamount = Billing::findOrfail($billing_id->id);
		$udpateamount->amount = $sum;
		$udpateamount->update();

    }

    public function destroy($client_id,$billing_id){

    	$billing = Billing::findOrfail($billing_id);
        $billing->delete();
        toast('Record has been deleted!','error');
        return redirect('dashboard/billing/'.$client_id.'/client');
    }

    public function receipt($rcode){
    	$billing = Billing::where('rcode',$rcode)->first();
    	return view('receipt.billingreceipt',compact('billing'))->with('title',$this->title);
    }
}

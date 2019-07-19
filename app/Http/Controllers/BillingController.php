<?php

namespace App\Http\Controllers;

use App\Client;
use App\Billing;
use App\Product;
use App\Appointment;
use App\BillingProduct;
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
    	$i=0;
    	if($client->patients){
    		foreach($client->patients as $patient){
    			if($patient->appointments){
    				foreach ($patient->appointments as $appointment) {
    					if($appointment->isPaid == 0){
    						$i++;
    					}
    				}
    			}
    		}
    	}

    	if($i == 1){
    		return view('billing.create',compact('client','products'))->with('title',$this->title);
    	}else{
    		toast('There are no patients that has unpaid appointment.','error');
        	return redirect('dashboard/billing/'.$id.'/client');
    	}
	
    	
    }

    public function store($id){
    	$data = request()->validate([
    	      'rcode' => 'required',
    	  ]);

    	$data['amount'] = 0;
    	$data['client_id'] = $id;

    	$billing_id = Billing::create($data);
    	$sum = $sum1 = $sum2 = 0;
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
    	      	$sum1 = $sum1 + request()->amount[$key];
    	      }

    	}
    	// if product exists
		if (request()->product_name) {

			foreach (request()->hidden_id as $key => $value) {
				$product = Product::findOrfail(request()->hidden_id[$key]);
				$billingproduct = new BillingProduct();
				$billingproduct->billing_id = $billing_id->id;
				$billingproduct->name = request()->hidden_prodname[$key];
				$billingproduct->category = request()->product_category[$key];
				$billingproduct->unit = request()->product_unit[$key];
				$billingproduct->price = request()->product_price[$key];
				$billingproduct->quantity = request()->product_quantity[$key];
				$billingproduct->netamount = (request()->product_price[$key] - $product->original) * request()->product_quantity[$key] + $sum1;
				$amount = request()->product_price[$key] * request()->product_quantity[$key];
				$billingproduct->save();
				// get total amount of products
				$sum2 = $sum2 + $amount;
			}
		}
		$sum = $sum1 + $sum2;
    	$udpateamount = Billing::findOrfail($billing_id->id);
		$udpateamount->amount = $sum;
		$udpateamount->update();
		return redirect('dashboard/billing/'.$id.'/client');
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

<?php

namespace App\Http\Controllers;

use App\Product;
use App\StockOut;
use App\Systemlog;
use App\StockOutDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockOutController extends BaseController
{
	public $title = "Point of Sale";

    public function index(){
    	$products = Product::orderBy('created_at','desc')->get();
    	return view('stockout.index',compact('products'))->with('title',$this->title);
    }

    public function store(Request $request){

    	$data = $request->validate([
    	      'rcode' => 'required',
    	  ]);

    	  $data['amount'] = 1;

    	  $stockout_id = StockOut::create($data);
    	  
    	  $sum = 0;
    	  $i=0;
    	  foreach($request->id as $id){
    	      // update the product
    	      $product = Product::findOrfail($id);
    	      $product->quantity = $product->quantity - $request['quantity'][$i];
    	      $product->update();
    	      // get the total amount
    	      $sum = $sum + ($request['price'][$i] * $request['quantity'][$i]);
    	      // insert to stockoutdetails
    	      $stockoutdetails = new StockOutDetail();
    	      $stockoutdetails->name = $request['name'][$i];
    	      $stockoutdetails->stock_out_id = $stockout_id->id;
    	      $stockoutdetails->category = $request['category'][$i];
              $stockoutdetails->unit = $request['unit'][$i];
              $netamnt = $request['price'][$i] - $request['original'][$i];
    	      $stockoutdetails->netamount = $netamnt * $request['quantity'][$i];
              $stockoutdetails->price = $request['price'][$i];
    	      $stockoutdetails->quantity = $request['quantity'][$i];
    	      $stockoutdetails->amount = $request['price'][$i] * $request['quantity'][$i];
    	      $stockoutdetails->save();

    	      $i++;

    	  }


    	  $udpateamount = StockOut::findOrfail($stockout_id->id);
    	  $udpateamount->amount = $sum;
    	  $udpateamount->update();

          //logging the activity
                  \App\Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role),'activity' =>' Added new transaction from point of sales with an amount of ₱'.$sum]);

    	  toast('Successfully added!','success');
    	  return redirect('dashboard/receipt/'.$data['rcode'])->with('title',$this->title);
    }
}

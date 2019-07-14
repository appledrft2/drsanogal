<?php

namespace App\Http\Controllers;

use App\StockOut;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
	public $title = "Report";

    public function index($rcode){
    	$receipt = StockOut::where('rcode',$rcode)->first();


    	return view('receipt.index',compact('receipt'))->with('title',$this->title);
    }
}

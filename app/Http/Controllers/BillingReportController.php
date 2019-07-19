<?php

namespace App\Http\Controllers;

use App\Billing;
use App\BillingProduct;
use Illuminate\Http\Request;

class BillingReportController extends Controller
{
	public $title = "Billing Report";
    public function index(){
    	$jan = BillingProduct::where('created_at','like','%'.date('Y').'-01'.'%')->sum('netamount');
    	$feb = BillingProduct::where('created_at','like','%'.date('Y').'-02'.'%')->sum('netamount');
    	$march = BillingProduct::where('created_at','like','%'.date('Y').'-03'.'%')->sum('netamount');
    	$april = BillingProduct::where('created_at','like','%'.date('Y').'-04'.'%')->sum('netamount');
    	$may = BillingProduct::where('created_at','like','%'.date('Y').'-05'.'%')->sum('netamount');
    	$june = BillingProduct::where('created_at','like','%'.date('Y').'-06'.'%')->sum('netamount');
    	$july = BillingProduct::where('created_at','like','%'.date('Y').'-07'.'%')->sum('netamount');
    	$aug = BillingProduct::where('created_at','like','%'.date('Y').'-08'.'%')->sum('netamount');
    	$sept = BillingProduct::where('created_at','like','%'.date('Y').'-09'.'%')->sum('netamount');
    	$oct = BillingProduct::where('created_at','like','%'.date('Y').'-10'.'%')->sum('netamount');
    	$nov = BillingProduct::where('created_at','like','%'.date('Y').'-11'.'%')->sum('netamount');
    	$dec = BillingProduct::where('created_at','like','%'.date('Y').'-12'.'%')->sum('netamount');


    	$reports = Billing::orderBy('created_at','desc')->get();
    	return view('billingreport.index',compact(
    		'reports',
    		'jan',
    		'feb',
    		'march',
    		'april',
    		'may',
    		'june',
    		'july',
    		'aug',
    		'sept',
    		'oct',
    		'nov',
    		'dec'))->with('title',$this->title);
    }
}

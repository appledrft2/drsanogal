<?php

namespace App\Http\Controllers;

use App\StockOut;
use Carbon\Carbon;
use App\StockOutDetail;
use Illuminate\Http\Request;

class ReportController extends BaseController
{
	public $title = "Report";
    public function index(){
    	$jan = StockOutDetail::where('created_at','like','%'.date('Y').'-01'.'%')->sum('netamount');
    	$feb = StockOutDetail::where('created_at','like','%'.date('Y').'-02'.'%')->sum('netamount');
    	$march = StockOutDetail::where('created_at','like','%'.date('Y').'-03'.'%')->sum('netamount');
    	$april = StockOutDetail::where('created_at','like','%'.date('Y').'-04'.'%')->sum('netamount');
    	$may = StockOutDetail::where('created_at','like','%'.date('Y').'-05'.'%')->sum('netamount');
    	$june = StockOutDetail::where('created_at','like','%'.date('Y').'-06'.'%')->sum('netamount');
    	$july = StockOutDetail::where('created_at','like','%'.date('Y').'-07'.'%')->sum('netamount');
    	$aug = StockOutDetail::where('created_at','like','%'.date('Y').'-08'.'%')->sum('netamount');
    	$sept = StockOutDetail::where('created_at','like','%'.date('Y').'-09'.'%')->sum('netamount');
    	$oct = StockOutDetail::where('created_at','like','%'.date('Y').'-10'.'%')->sum('netamount');
    	$nov = StockOutDetail::where('created_at','like','%'.date('Y').'-11'.'%')->sum('netamount');
    	$dec = StockOutDetail::where('created_at','like','%'.date('Y').'-12'.'%')->sum('netamount');


    	$reports = StockOut::orderBy('created_at','desc')->get();
    	return view('report.index',compact(
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
    public function generateReport(){

        $data = request()->validate([
                    'from'=>'required',
                    'to'=>'required',
                ]);
                    $carbfrom = new Carbon($data['from']);
                    $carbto = new Carbon($data['to']);

                    $carbto->addDays(1);

                    $reports = StockOut::where('created_at', '>', $carbfrom)
                           ->where('created_at', '<', $carbto)
                           ->get();


        $jan = StockOutDetail::where('created_at','like','%'.date('Y').'-01'.'%')->sum('netamount');
        $feb = StockOutDetail::where('created_at','like','%'.date('Y').'-02'.'%')->sum('netamount');
        $march = StockOutDetail::where('created_at','like','%'.date('Y').'-03'.'%')->sum('netamount');
        $april = StockOutDetail::where('created_at','like','%'.date('Y').'-04'.'%')->sum('netamount');
        $may = StockOutDetail::where('created_at','like','%'.date('Y').'-05'.'%')->sum('netamount');
        $june = StockOutDetail::where('created_at','like','%'.date('Y').'-06'.'%')->sum('netamount');
        $july = StockOutDetail::where('created_at','like','%'.date('Y').'-07'.'%')->sum('netamount');
        $aug = StockOutDetail::where('created_at','like','%'.date('Y').'-08'.'%')->sum('netamount');
        $sept = StockOutDetail::where('created_at','like','%'.date('Y').'-09'.'%')->sum('netamount');
        $oct = StockOutDetail::where('created_at','like','%'.date('Y').'-10'.'%')->sum('netamount');
        $nov = StockOutDetail::where('created_at','like','%'.date('Y').'-11'.'%')->sum('netamount');
        $dec = StockOutDetail::where('created_at','like','%'.date('Y').'-12'.'%')->sum('netamount');


        return view('report.index',compact(
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

<?php

namespace App\Http\Controllers;

use App\StockOut;
use Illuminate\Http\Request;

class ReportController extends Controller
{
	public $title = "Report";
    public function index(){
    	$reports = StockOut::orderBy('created_at','desc')->get();
    	return view('report.index',compact('reports'))->with('title',$this->title);
    }
}

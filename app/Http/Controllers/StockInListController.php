<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class StockInListController extends Controller
{
	public $title = 'Stock In';

    public function index(){
    	$suppliers = Supplier::orderBy('created_at','desc')->paginate(4);
    	
    	return view('stockinlist.index',compact('suppliers'))->with('title',$this->title);
    }
}

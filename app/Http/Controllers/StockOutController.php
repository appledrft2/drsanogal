<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
	public $title = "Stock Out";

    public function index(){
    	$products = Product::orderBy('created_at','desc')->get();
    	return view('stockout.index',compact('products'))->with('title',$this->title);
    }

    public function store(Request $request){
    	dd($request->all());
    }
}

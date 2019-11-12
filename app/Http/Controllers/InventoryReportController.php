<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\StockOutDetail;
use App\dynamic_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class InventoryReportController extends BaseController
{
	public $title = "Inventory Report";
    public function index(){


        
        


        // get inventory date
    	$today = date('Y-m-d');
    	$dates = StockOutDetail::latest()
    	->groupBy('date')
        ->orderBy('date', 'DESC')
        ->get(array(
            DB::raw('DATE(created_at) as date'),
        ));
        // get inventory products based on date
        $stockouts = [];
        $i=0;
        foreach($dates as $date){
        	$stockouts[$i] = StockOutDetail::where('created_at','like','%'.$date->date.'%')
        	->groupBy('name')
        	->get(array(
        		DB::raw('created_at as date'),
        		DB::raw('name'),
        		DB::raw('price'),
        		DB::raw('sum(quantity) as quantity'),
        		DB::raw('sum(netamount) as netamount'),
        		

        	));
        	$i++;
        }



    	

    	return view('inventoryreport.index',compact('stockouts','dates'))->with('title',$this->title);
    }

    public function generateReport(){
    	$data = request()->validate([
    		'from'=>'required',
    		'to'=>'required',
    	]);
    		$carbfrom = new Carbon($data['from']);
    		$carbto = new Carbon($data['to']);
            $carbto->addDays(1);


    	
    	if($carbfrom > $carbto){
    		return 'from cannot be greater than to';
    	}
    	else if($carbfrom == $carbto){
    			$dates = StockOutDetail::where('created_at', 'like','%'.$data['from'].'%')
    			->groupBy('date')
    		    ->orderBy('date', 'DESC')
    		    ->get(array(
    		        DB::raw('DATE(created_at) as date'),
    		    ));
    	}
    	else if($carbfrom->addDays(1) == $carbto){
    			$dates = StockOutDetail::where(function ($query) use($data) {
    			    $query->where('created_at', 'like', '%'.$data['from'].'%')
    			          ->orWhere('created_at', 'like', '%'.$carbto.'%');    
    			})
    			->groupBy('date')
    			->get(array(
        		DB::raw('DATE(created_at) as date')));
    	}
    
		else if($carbfrom < $carbto){
    			$dates = StockOutDetail::whereBetween('created_at', [$data['from'],$carbto])
    			->groupBy('date')
    		    ->orderBy('date', 'DESC')
    		    ->get(array(
    		        DB::raw('DATE(created_at) as date'),
    		    ));
    	}
    	

        $stockouts = [];
        $i=0;
        foreach($dates as $date){

        	$stockouts[$i] = StockOutDetail::where('created_at','like','%'.$date->date.'%')
        	->groupBy('name')
        	->get(array(
        		DB::raw('created_at as date'),
        		DB::raw('name'),
        		DB::raw('price'),
        		DB::raw('sum(quantity) as quantity'),
        		DB::raw('sum(netamount) as netamount'),
        		

        	));
        	$i++;
        }

      
    	

    	return view('inventoryreport.index',compact('stockouts','dates'))->with('title',$this->title);
    }
}

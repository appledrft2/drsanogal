<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class StockInListController extends Controller
{
	public $title = 'Stock In';

    public function index(){
    	$suppliers = Supplier::orderBy('created_at','desc')->get();

    	return view('stockinlist.index',compact('suppliers'))->with('title',$this->title);
    }

    public function search()
    {
        $data = request()->validate(['data'=>'required']);

        $suppliers = Supplier::where(function ($query) use($data) {
            $query->where('name', 'like', '%'.$data['data'].'%')
                  ->orWhere('contact','like','%'.$data['data'].'%')
                  ->orWhere('address','like','%'.$data['data'].'%');
        })->paginate(4);
        $suppliers =  $suppliers->appends(array ('data' => $data['data']));
        return view('stockinlist.index',compact('suppliers'))->with('title',$this->title)->with('btn',true);
    }
}

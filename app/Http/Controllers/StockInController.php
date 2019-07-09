<?php

namespace App\Http\Controllers;

use App\StockIn;
use App\Supplier;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public $title = "Stock In";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($supplier)
    {
        $supplier = Supplier::findOrfail($supplier);
        $stockins = Stockin::orderBy('created_at','desc')->paginate(4);
        return view('stockin.index',compact('stockins','supplier'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($supplier_id)
    {
        $products = Supplier::findOrfail($supplier_id)->products()->orderBy('created_at','desc')->get();
        $supplier = Supplier::findOrfail($supplier_id);
        return view('stockin.create',compact('supplier','products'))->with('title',$this->title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($supplier,Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockIn  $stockIn
     * @return \Illuminate\Http\Response
     */
    public function show($supplier,StockIn $stockIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockIn  $stockIn
     * @return \Illuminate\Http\Response
     */
    public function edit($supplier,StockIn $stockIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockIn  $stockIn
     * @return \Illuminate\Http\Response
     */
    public function update($supplier,Request $request, StockIn $stockIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockIn  $stockIn
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplier,StockIn $stockIn)
    {
        //
    }
}

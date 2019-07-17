<?php

namespace App\Http\Controllers;

use App\ProductUnit;
use Illuminate\Http\Request;

class ProductUnitController extends Controller
{
    public $title = "Product";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = ProductUnit::latest()->get();
       return view('productunit.index',compact('units'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);

        $status = ProductUnit::create($data);

        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record added successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductUnit  $productUnit
     * @return \Illuminate\Http\Response
     */
    public function show(ProductUnit $productUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductUnit  $productUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductUnit $productUnit,$id)
    {
        $status = ProductUnit::findOrfail($id);

        if ($status){
            return response()->json([
                'status' => 'success',
                'title' => $status->title,
                'description' => $status->description
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductUnit  $productUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductUnit $productUnit,$id)
    {
        $status = ProductUnit::findOrfail($id);

       $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);

        $status->update($data);

        if ($status){
            return response()->json([
                'status' => 'success',
                'message' => 'Record updated successfully'
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductUnit  $productUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductUnit $productUnit,$id)
    {
        $status = ProductUnit::findOrfail($id);
        $status->delete();
        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record deleted successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }
}

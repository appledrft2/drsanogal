<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductCategoryController extends Controller
{
    public $title = "Product Category";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $categories = ProductCategory::latest()->get();
        return view('productcategory.index',compact('categories'))->with('title',$this->title);
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

        $status = ProductCategory::create($data);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = ProductCategory::findOrfail($id);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
       $status = ProductCategory::findOrfail($id);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = ProductCategory::findOrfail($id);
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

<?php

namespace App\Http\Controllers;

use App\FormCategory;
use Illuminate\Http\Request;

class FormCategoryController extends BaseController
{   
    public $title = "Attachments Category";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formcategorys = FormCategory::orderBy('created_at','desc')->get();
        return view('formcategory.index',compact('formcategorys'))->with('title',$this->title);
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
            'name' => 'required',
            'description' => 'nullable'
        ]);

        $status = FormCategory::create($data);

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
     * @param  \App\FormCategory  $formCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FormCategory $formCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormCategory  $formCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FormCategory $formCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormCategory  $formCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormCategory $formCategory,$id)
    {
        $status = FormCategory::findOrfail($id);

       $data = $request->validate([
            'name' => 'required',
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
     * @param  \App\FormCategory  $formCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormCategory $formCategory,$id)
    {
        $status = formCategory::findOrfail($id);
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

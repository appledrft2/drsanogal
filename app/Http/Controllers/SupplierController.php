<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Systemlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends BaseController
{
    public $title = "Supplier";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at','DESC')->get();

        return view('supplier.index',compact('suppliers'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create')->with('title',$this->title);
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
        return view('supplier.index',compact('suppliers'))->with('title',$this->title)->with('btn',true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name'=>'required',
            'contact'=>'required',
            'address'=>'required'
        ]);
        //logging the activity
        \App\Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role),'activity' =>' Created new supplier named "'.request()->name.'" ']);

        $status = Supplier::create($data);
        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record added successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit',compact('supplier'))->with('title',$this->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name'=>'required',
            'contact'=>'required',
            'address'=>'required'
        ]);
        //logging the activity
        \App\Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role),'activity' =>' Updated supplier named "'.$supplier->name.'"']);


        $status = $supplier->update($data);
        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record added successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //logging the activity
        \App\Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role),'activity' =>' Deleted supplier named "'.$supplier->name.'"']);
        $status = $supplier->delete();
        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record added successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record',
            ]);
        }
    }
}

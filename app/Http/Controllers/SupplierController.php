<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

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
        $suppliers = Supplier::orderBy('created_at','DESC')->paginate(4);

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

        Supplier::create($data);
        toast('Successfully added!','success');
        return redirect('dashboard/supplier');
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
        $supplier->update($data);
        toast('Record successfully updated!','success');
        return redirect('dashboard/supplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        toast('Record successfully deleted!','error');
        return redirect('dashboard/supplier');
    }
}

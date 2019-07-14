<?php

namespace App\Http\Controllers;

use App\Product;
use App\StockIn;
use App\Supplier;
use App\StockInDetail;
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
    public function store($supplier_id,Request $request)
    {   
      $data = $request->validate([
            'code' => 'required',
            'delivery_date' => 'required',
            'term' => 'required',
            'due' => 'required',
            'discount' => 'required',
          
        ]);
        $data['supplier_id'] = $supplier_id;
        
        $data['status'] = 'Unpaid';
        $data['amount'] = 1;

        $stockin_id = Stockin::create($data);
        
        $sum = 0;
        $i=0;
        foreach($request->id as $id){
            // update the product
            $product = Product::findOrfail($id);
            $product->original = $request['original'][$i];
            $product->price = $request['price'][$i];
            $product->quantity = $product->quantity + $request['quantity'][$i];
            $product->update();

            $subtotal = $request['original'][$i] * $request['quantity'][$i];
            // get the total amount
            $sum = $sum + $subtotal;
            // insert to stockindetails
            $stockindetails = new StockInDetail();
            $stockindetails->name = $request['name'][$i];
            $stockindetails->stockin_id = $stockin_id->id;
            $stockindetails->original = $request['original'][$i];
            $stockindetails->price = $request['price'][$i];
            $stockindetails->quantity = $request['quantity'][$i];
            $stockindetails->save();

            $i++;

        }

        $discount = $sum * $request->discount;

        $udpateamount = Stockin::findOrfail($stockin_id->id);
        $udpateamount->amount = $sum - $discount;
        $udpateamount->update();

        toast('Successfully added!','success');
        return redirect('dashboard/suppliers/'.$supplier_id.'/stockin')->with('title',$this->title);
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
    public function destroy($supplier_id,StockIn $stockIn)
    {

        $stockIn = StockIn::findOrfail(request()->sid);
        $stockIn->delete();
        toast('Record has been deleted!','error');
        return redirect('dashboard/suppliers/'.$supplier_id.'/stockin');
    }
}

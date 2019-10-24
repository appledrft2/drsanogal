<?php

namespace App\Http\Controllers;

use App\Product;
use App\StockIn;
use App\Supplier;
use App\Systemlog;
use App\ProductUnit;
use App\StockInDetail;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockInController extends Controller
{
    public $title = "Stock In";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($supplier_id)
    {
        $getprod = Product::where('supplier_id',$supplier_id)->get();
        if(count($getprod)){
        $supplier = Supplier::findOrfail($supplier_id);
        $stockins = Stockin::where('supplier_id',$supplier_id)->get();
        return view('stockin.index',compact('stockins','supplier'))->with('title',$this->title);
        }else{
            toast('There are no products with this supplier yet, please add a product for the chosen supplier','error');
            return redirect('dashboard/supplier');
        
        }
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
            'term' => 'nullable',
            'mop' => 'required',
            'partial' => 'nullable',
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

        if($request['mop'] == 'Partial'){
            $partial = $request['partial'];
            $sum = $sum - $partial;
        }

        $discount = $sum * $request->discount;
        $overall = $sum - $discount;
        $udpateamount = Stockin::findOrfail($stockin_id->id);
        $udpateamount->amount = $overall;

        $udpateamount->update();

        $supplier = Supplier::findOrfail($supplier_id);
        //logging the activity
        \App\Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role),'activity' =>' Added new delivery from supplier "'.$supplier->name.'" with an amount of ₱'.$overall]);

        toast('Successfully added!','success');
        return redirect('dashboard/suppliers/'.$supplier_id.'/stockin')->with('title',$this->title);
    }

    public function receipt($code){
        $stockin = Stockin::where('code',$code)->first();
        $details = StockInDetail::where('stockin_id',$stockin->id)->get();

        return view('receipt.stockinreceipt',compact('stockin','details'))->with('title',$this->title);
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

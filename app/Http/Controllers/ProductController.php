<?php

namespace App\Http\Controllers;

use App\Product;
use App\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $title = "Product";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::orderBy('created_at','DESC')->paginate(4);
        return view('product.index',compact('products'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('product.create',compact('suppliers'))->with('title',$this->title);
    }

    public function search()
    {
        $data = request()->validate(['data'=>'required']);

        $products = Product::where(function ($query) use($data) {
            $query->where('name', 'like', '%'.$data['data'].'%')
                  ->orWhere('category', 'like', '%'.$data['data'].'%')
                  ->orWhere('supplier_id', 'like', '%'.$data['data'].'%');        
        })->paginate(4);
        $products =  $products->appends(array ('data' => $data['data']));
        return view('product.index',compact('products'))->with('title',$this->title)->with('btn',true);
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
            'supplier_id'=>'required',
            'name'=>'required',
            'category'=>'required',
            'unit'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'lowstock'=>'required'
        ]);

        Product::create($data);
        toast('Successfully added!','success');
        return redirect('dashboard/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        return view('product.edit',['product'=>$product,'suppliers'=>$suppliers])->with('title',$this->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = request()->validate([
            'supplier_id'=>'required',
            'name'=>'required',
            'category'=>'required',
            'unit'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'lowstock'=>'required'
        ]);

        $product->update($data);
        toast('Record successfully updated!','success');
        return redirect('dashboard/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        toast('Record successfully deleted!','error');
        return redirect('dashboard/product');
    }
}

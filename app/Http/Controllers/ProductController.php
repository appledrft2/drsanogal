<?php

namespace App\Http\Controllers;

use App\Product;
use App\Supplier;
use App\ProductUnit;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $suppliers = Supplier::orderBy('created_at','DESc')->get();
        $units = ProductUnit::orderBy('created_at','DESc')->get();
        $category = ProductCategory::orderBy('created_at','DESc')->get();
        $products = Product::orderBy('created_at','DESC')->get();
        return view('product.index',compact('products','suppliers','category','units'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $units = ProductUnit::orderBy('created_at','asc')->get();
        $category = ProductCategory::orderBy('created_at','asc')->get();
        return view('product.create',compact('suppliers','category','units'))->with('title',$this->title);
    }

    public function search()
    {
        $data = request()->validate(['data'=>'required']);

        $products = Product::where(function ($query) use($data) {
            $query->where('name', 'like', '%'.$data['data'].'%')
                  ->orWhere('category', 'like', '%'.$data['data'].'%')
                  ->orWhere('supplier_id', 'like', '%'.$data['data'].'%');        
        })->paginate(4);
        $suppliers = Supplier::orderBy('created_at','DESc')->get();
        $units = ProductUnit::orderBy('created_at','DESc')->get();
        $category = ProductCategory::orderBy('created_at','DESc')->get();
        $products =  $products->appends(array ('data' => $data['data']));
        $btn = Supplier::findOrfail($data['data']);
        return view('product.index',compact('products','suppliers','category','units','btn'))->with('title',$this->title);
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
            'original'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'lowstock'=>'required',
            'image' => 'image|nullable|max:1999'
        ]);

        //handle file uploading
        if($request->hasFile('image')){
           
            if($request->file('image') != 'uploads/noimage.png'){
                $path = request()->file('image');
                $pathToSave = Storage::disk('s3')->put('uploads',$path,'public');
           }

        }else{
            $pathToSave = 'uploads/noimage.png';
        }
        // Save filename to database
        $data['image'] = $pathToSave;

        $status = Product::create($data);
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
            'lowstock'=>'required',
            'image' => 'image|nullable|max:1999'
        ]);

        //handle file uploading
        if($request->hasFile('image')){
             if($request->file('image') != 'uploads/noimage.png'){
            	// finds the old image and delete
            	Storage::disk('s3')->delete($product->image);
        	}

            // upload new image
            $path = request()->file('image');
            $pathToSave = Storage::disk('s3')->put('uploads',$path,'public');

            // Save filename to database
            $data['image'] = $pathToSave;
        }


        $status = $product->update($data);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image != 'uploads/noimage.png'){
            // Delete image
            Storage::disk('s3')->delete($product->image);
        }

        $status = $product->delete();
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
}

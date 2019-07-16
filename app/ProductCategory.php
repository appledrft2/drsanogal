<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $guarded = [];



    public function product(){
    	return $this->belongsTo(Product::class);
    }
}

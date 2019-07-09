<?php

namespace App;

use App\Product;
use App\StockIn;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = [];

    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function stockins(){
    	return $this->hasMany(StockIn::class);
    }
}

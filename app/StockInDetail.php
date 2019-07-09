<?php

namespace App;

use App\Product;
use App\StockIn;
use Illuminate\Database\Eloquent\Model;

class StockInDetail extends Model
{
    protected $guarded = [];

    public function stockin(){
    	return $this->belongsTo(StockIn::class);
    }
   
}

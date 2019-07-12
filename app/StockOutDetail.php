<?php

namespace App;

use App\StockOut;
use Illuminate\Database\Eloquent\Model;

class StockOutDetail extends Model
{
    protected $guarded = [];

    public function stockout(){
    	return $this->belongsTo(StockOut::class);
    }
}

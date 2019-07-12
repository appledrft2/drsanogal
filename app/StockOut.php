<?php

namespace App;

use App\StockOutDetail;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $guarded = [];

    public function stockoutdetails(){
    	return $this->hasMany(StockOutDetail::class);
    }
}

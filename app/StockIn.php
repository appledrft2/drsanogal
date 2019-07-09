<?php

namespace App;

use App\Supplier;
use App\StockInDetail;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
	protected $guarded = [];

	public function supplier(){
		return $this->belongsTo(Supplier::class);
	}
	public function stockindetails(){
		return $this->hasMany(StockInDetail::class);
	}
}

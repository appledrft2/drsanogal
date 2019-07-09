<?php

namespace App;

use App\Supplier;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
	protected $guarded = [];

	public function supplier(){
		$this->belongsTo(Supplier::class);
	}
}

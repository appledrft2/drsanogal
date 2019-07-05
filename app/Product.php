<?php

namespace App;

use App\Supplier;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function supplier(){
    	return $this->belongsTo(Supplier::class);
    }

    public function setTotal() {
    	$this->total = $this->price * $this->quantity;
	}
}
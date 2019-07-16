<?php

namespace App;

use App\Supplier;
use App\StockInDetail;
use App\ProductCategory;
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

	public function productCategories(){
		return $this->hasMany(ProductCategory::class);
	}
}

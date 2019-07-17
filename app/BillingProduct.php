<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingProduct extends Model
{
    protected $guarded = [];

    public function billing(){
    	return $this->belongsTo(Billing::class);
    }
}

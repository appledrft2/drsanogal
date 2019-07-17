<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingService extends Model
{
    protected $guarded = [];

    public function billing(){
    	return $this->belongsTo(Billing::class);
    }
}

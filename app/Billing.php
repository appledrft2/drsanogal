<?php

namespace App;

use App\BillingService;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $guarded = [];

    public function services(){
    	return $this->hasMany(BillingService::class);
    }

    public function products(){
    	return $this->hasMany(BillingProduct::class);
    }
    public function client(){
    	return $this->belongsTo(Client::class);
    }
}

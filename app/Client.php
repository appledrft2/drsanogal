<?php

namespace App;

use App\Billing;
use App\Patient;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function patients(){
    	return $this->hasMany(Patient::class);
    }

    public function billings(){
    	return $this->hasMany(Billing::class);
    }

    public function forms(){
    	return $this->hasMany(Forms::class);
    }
}

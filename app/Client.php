<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function patients(){
    	return $this->hasMany(Patient::class);
    }
}

<?php

namespace App;

use App\Client;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    public function client(){
    	return $this->belongsTo(Client::class);
    }
}

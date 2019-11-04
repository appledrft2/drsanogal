<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
	protected $clientnotif;

	  public function __construct() 
	  {
	      // Fetch the Site Settings object
	      $this->clientnotif = Client::all();
	      View::share('clientnotif', $this->clientnotif);
	  }

}

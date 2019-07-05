<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
	protected $lowprod;

    public function __construct() 
    {
        // Fetch the Site Settings object
        $this->lowprod = Product::where('quantity','<=',10)->get();
        View::share('lowprod', $this->lowprod);
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Systemlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role) ,'activity' => "Logged In Successfully"]);
        toast('Successfully Logged In','success');
        return redirect('/dashboard');
    }


   
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
        toast('Welcome to the dashboard!','info');
        return redirect('/dashboard')->with('title','Dashboard');
    }

    public function welcome(){
        $announcements = \App\Announcement::orderBy('created_at','DESC')->paginate(4);
        return view('welcome',compact('announcements'));
    }
    public function about(){
         return view('about');
    }
    public function products(){
        $products = \App\Product::orderBy('created_at','DESC')->paginate(3);
        return view('products',compact('products'));
    }
}

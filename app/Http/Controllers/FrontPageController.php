<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontPageController extends Controller
{
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

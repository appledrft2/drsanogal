<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontPageController extends Controller
{
     public function welcome(){
        
        return view('welcome');
    }
    public function announcement(){
        $announcements = \App\Announcement::orderBy('created_at','DESC')->paginate(4);
         return view('about',compact('announcements'));
    }
    public function products(){
        $products = \App\Product::orderBy('created_at','DESC')->paginate(3);
        return view('products',compact('products'));
    }
    public function services(){
        $services = \App\ManageAppointment::orderBy('created_at','DESC')->paginate(6);
        return view('services',compact('services'));
    }
}

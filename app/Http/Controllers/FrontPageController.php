<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontPageController extends Controller
{
     public function welcome(){
        $initialInstall = \App\User::where('role','=','doctor')->count();
   
        return view('welcome',compact('initialInstall'));
    }
    public function announcement(){
         $initialInstall = \App\User::where('role','=','doctor')->count();
        $announcements = \App\Announcement::orderBy('created_at','DESC')->paginate(4);
         return view('about',compact('announcements','initialInstall'));
    }
    public function products(){
         $initialInstall = \App\User::where('role','=','doctor')->count();
        $products = \App\Product::orderBy('created_at','DESC')->paginate(3);
        return view('products',compact('products','initialInstall'));
    }
    public function services(){
         $initialInstall = \App\User::where('role','=','doctor')->count();
        $services = \App\ManageAppointment::orderBy('created_at','DESC')->paginate(6);
        return view('services',compact('services','initialInstall'));
    }
}

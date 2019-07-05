<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
	public $title = "My Profile";

    public function index(){
    	return view('profile.index')->with('title',$this->title);
    }
    public function update($id){

    	$data = request()->validate([
            'name'=>'required',
            'email'=>'required',
        ]);
        $user = User::findOrfail($id);
        $user->update($data);
        toast('Record successfully updated!','success');
        return redirect('dashboard/profile');
    }
    public function UpdatePassword($id){
    	$data = request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::findOrfail($id);
        $user->update($data);
        toast('Record successfully updated!','success');
        return redirect('dashboard/profile');
    }
}

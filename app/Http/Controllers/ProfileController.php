<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends BaseController
{
	public $title = "My Profile";

    public function index(){
    	return view('profile.index')->with('title',$this->title);
    }
    public function update($id){

    	$data = request()->validate([
            'name'=>'required',
            'email'=>'required',
            'image' => 'image|nullable|max:1999'
        ]);

        $user = User::findOrfail($id);

         //handle file uploading
        if(request()->hasFile('image')){
            if($user->image != 'uploads/no-profile.jpg'){
                // finds the old image and delete
                Storage::disk('s3')->delete($user->image);
            }

            // upload new image
            $path = request()->file('image');
            $pathToSave = Storage::disk('s3')->put('uploads',$path,'public');

            // Save filename to database
            $data['image'] = $pathToSave;
        }

        
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

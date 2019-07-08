<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public $title = "Account";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at','desc')->paginate(4);

        return view('account.index',compact('users'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create')->with('title',$this->title);
    }

    public function search()
    {
        $data = request()->validate(['data'=>'required']);

        $users = User::where(function ($query) use($data) {
            $query->where('name', 'like', '%'.$data['data'].'%')
                  ->orWhere('email', 'like', '%'.$data['data'].'%')
                  ->orWhere('role','like','%'.$data['data'].'%');
        })->paginate(4);
        $users =  $users->appends(array ('data' => $data['data']));
        return view('account.index',compact('users'))->with('title',$this->title)->with('btn',true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name'=>['required', 'string', 'max:255'],
            'email'=> ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'=>['required', 'string', 'max:255'],
            'password'=>['required', 'string', 'min:8', 'confirmed'],
            'image' => 'image|nullable|max:1999'
        ]);

        $data['image'] = 'uploads/no-profile.jpg';

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        toast('Successfully added!','success');
        return redirect('dashboard/account');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('account.edit',compact('user'))->with('title',$this->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $data = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role'=>'required',
        ]);
        $user = User::findOrfail($id);
        $user->update($data);
        toast('Record successfully updated!','success');
        return redirect('dashboard/account');
    }

    public function UpdatePassword($id){
        $data = request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::findOrfail($id);
        $user->update($data);
        toast('Record successfully updated!','success');
        return redirect('dashboard/account');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        if($user->image != 'uploads/no-profile.jpg'){
            // Delete image
            Storage::disk('s3')->delete($user->image);
        }
        
        $user->delete();
        toast('Record successfully updated!','success');
        return redirect('dashboard/account');
    }
}

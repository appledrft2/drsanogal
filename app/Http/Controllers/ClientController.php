<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends BaseController
{

    public $title = 'Client';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('created_at','DESC')->get();
 
        return view('client.index',compact('clients'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create')->with('title',$this->title);
    }

    public function search()
    {
        $data = request()->validate(['data'=>'required']);

        $clients = Client::where(function ($query) use($data) {
            $query->where('name', 'like', '%'.$data['data'].'%')
                  ->orWhere('gender', 'like', '%'.$data['data'].'%')
                  ->orWhere('contact','like','%'.$data['data'].'%')
                  ->orWhere('address','like','%'.$data['data'].'%');
        })->paginate(4);
        $clients =  $clients->appends(array ('data' => $data['data']));
        return view('client.index',compact('clients'))->with('title',$this->title)->with('btn',true);
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
            'name'=>'required|unique:clients|max:255',
            'gender'=>'required',
            'occupation'=>'nullable',
            'status' => 'required',
            'address'=>'required',
            'smsNotify'=>'required',
            'email'=>'nullable|max:255',
            'contact'=>'nullable|unique:clients|max:255',
            'work'=>'nullable|unique:clients|max:255',
            'home'=>'nullable|unique:clients|max:255'
        ]);




        $status = Client::create($data);

        //logging the activity
        \App\Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role),'activity' =>' Added new client named "'.request()->name.'" ']);

        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record added successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem with the record',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit',compact('client'))->with('title',$this->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name'=>'required|max:255',
            'gender'=>'required',
            'occupation'=>'nullable',
            'status' => 'required',
            'address'=>'required',
            'smsNotify'=>'required',
            'email'=>'nullable|max:255',
            'contact'=>'nullable|max:255',
            'work'=>'nullable|max:255',
            'home'=>'nullable|max:255'
        ]);


        //logging the activity
        \App\Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role),'activity' =>' Updated client named "'.$client->name.'"']);

        $status = $client->update($data);

        


        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record Updated successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {

        //logging the activity
        \App\Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role),'activity' => ' Deleted  client named "'.$client->name.'" ']);
        
        $status = $client->delete();

        

        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record Deleted successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record'
            ]);
        }
    }
}

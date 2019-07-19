<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
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
            'name'=>'required',
            'gender'=>'required',
            'occupation'=>'required',
            'contact'=>'required',
            'address'=>'required',
            'smsNotify'=>'required',
            'email'=>'nullable'
        ]);

        $data['work'] = (request()->work) ? request()->work : ' ';
        $data['home'] =  (request()->home) ? request()->home : ' ';
         $data['email'] =  (request()->email) ? request()->email : ' ';


        $status = Client::create($data);
        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record added successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record',
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
            'name'=>'required',
            'gender'=>'required',
            'contact'=>'required',
            'address'=>'required',
            'occupation'=>'required',
            'smsNotify'=>'required',
            'email'=>'nullable',
        ]);

        $data['work'] = (request()->work) ? request()->work : ' ';
        $data['home'] =  (request()->home) ? request()->home : ' ';
        $data['email'] =  (request()->email) ? request()->email : ' ';



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

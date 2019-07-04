<?php

namespace App\Http\Controllers;

use App\Client;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public $title = "Client";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client)
    {
        $client = Client::findOrfail($client);
        $patients = Patient::where('client_id',$client)->paginate(4);
        return view('patient.index',['patients'=>$patients,'client'=>$client])->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client)
    {
        return view('patient.create',compact('client'))->with('title',$this->title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($client,Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'breed' => 'required',
            'specie' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
        ]);
        
        $data['client_id'] = $client;

        Patient::create($data);

        return redirect('dashboard/client/'.$client.'/patient')->with('success','Successfully Added!')->with('title',$this->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($client,Patient $patient)
    {
        $patient->delete();

        return redirect('dashboard/client/'.$client.'/patient')->with('success','Sucessfully Deleted!');
    }
}

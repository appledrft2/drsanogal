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
        $patients = Client::findOrfail($client)->patients()->get();
        $client = Client::findOrfail($client);
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

    public function search($client)
    {
        $data = request()->validate(['data'=>'required']);

        $patients = Client::findOrfail($client)->patients()->where(function ($query) use($data) {
            $query->where('id', 'like', '%'.$data['data'].'%')
                  ->orWhere('name', 'like', '%'.$data['data'].'%')
                  ->orWhere('breed', 'like', '%'.$data['data'].'%')
                  ->orWhere('specie','like','%'.$data['data'].'%')
                  ->orWhere('gender','like','%'.$data['data'].'%')
                  ->orWhere('date_of_birth','like','%'.$data['data'].'%');
        })->paginate(4);
        $patients =  $patients->appends(array ('data' => $data['data']));
        $client = Client::findOrfail($client);
        return view('patient.index',['patients'=>$patients,'client'=>$client])->with('title',$this->title)->with('btn',true);
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
            'veterinarian' => 'required',
        ]);

        $markings = (request('markings')) ? request('markings') : "none";
        $special_considerations = (request('special_considerations')) ? request('special_considerations') : "none";
        $data['client_id'] = $client;
        $data['markings'] = $markings;
        $data['special_considerations'] = $special_considerations;

        $status = Patient::create($data);
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
    public function edit($client,Patient $patient)
    {
        return view('patient.edit',['patient'=>$patient,'client'=>$client])->with('title',$this->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update($client,Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name' => 'required',
            'breed' => 'required',
            'specie' => 'required',
            'date_of_birth' => 'required',
            'veterinarian' => 'required',
            'gender' => 'required',
            'markings' => 'required',
            'special_considerations' => 'required'
        ]);


        $status = $patient->update($data);

        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record updated successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($client,Patient $patient)
    {
        $status = $patient->delete();
        if ($status) {
            return response()->json([
                'status'     => 'success',
                'message' => 'Record deleted successfully'

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'there was a problem updating the record',
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Systemlog;
use Illuminate\Http\Request;

class SystemlogController extends Controller
{
    public $title = "System Logs";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $logs = Systemlog::OrderBy('created_at','DESC')->get();
        return view('systemlog.index',compact('logs'))->with('title',$this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Systemlog  $systemlog
     * @return \Illuminate\Http\Response
     */
    public function show(Systemlog $systemlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Systemlog  $systemlog
     * @return \Illuminate\Http\Response
     */
    public function edit(Systemlog $systemlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Systemlog  $systemlog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Systemlog $systemlog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Systemlog  $systemlog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Systemlog $systemlog)
    {
        //
    }
}

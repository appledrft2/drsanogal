@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="jumbotron">
		<h1 class="display-4 text-display">Welcome to the dashboard!</h1>
	</div>

	<div class="row">
		<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bullhorn"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Announcements</span>
                <span class="info-box-number text-center">
                  {{$announcements}}    
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Clients</span>
                <span class="info-box-number text-center">
                  {{$clients}}    
                </span>
              </div>
            </div>
          </div>
	</div>
@endsection
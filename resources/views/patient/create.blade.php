@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<button onclick="history.back()" class="btn btn-default">Go Back</button>
	</div>
	<div class="card">
		<div class="card-header">New Patient</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/client/{{$client}}/patient">
				@csrf
				<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Name" value="{{old('name')}}" ></div>
				<div class="form-group"><input type="text" name="breed" class="form-control " placeholder="Breed" value="{{old('breed')}}" ></div>
				<div class="form-group"><input type="date" name="date_of_birth" class="form-control " placeholder="birthday" value="{{old('date_of_birth')}}" ></div>
				<div class="form-group">
					<select  name="specie" class="form-control ">
					<option value="">Specie</option>
					<option @if(old('specie')=='Canine') selected @endif>Canine</option>
					<option @if(old('specie')=='Feline') selected @endif>Feline</option>
					</select>
				</div>
				<div class="form-group">
					<select  name="gender" class="form-control ">
					<option value="">Gender</option>
					<option @if(old('gender')=='Male') selected @endif>Male</option>
					<option @if(old('gender')=='Female') selected @endif>Female</option>
					<option @if(old('gender')=='Neutered') selected @endif>Neutered (Male)</option>
					<option @if(old('gender')=='Spayed') selected @endif>Spayed (Female)</option>
					</select>
				</div>
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>

			</form>
		</div>
	</div>
</div>
@endsection
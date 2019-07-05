@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/client/{{$client}}/patient" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">Update Patient</div>
		<div class="card-body">
			<form method="POST" action="/dashboard/client/{{$client}}/patient/{{$patient->id}}">
				@method('PUT')
				@csrf
				<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Name" value="{{$patient->name}}" ></div>
				<div class="form-group"><input type="text" name="breed" class="form-control " placeholder="Breed" value="{{$patient->breed}}" ></div>
				<div class="form-group"><input type="date" name="date_of_birth" class="form-control " placeholder="birthday" value="{{$patient->date_of_birth}}" ></div>
				<div class="form-group">
					<select  name="specie" class="form-control ">
					<option value="">Specie</option>
					<option @if($patient->specie=='Canine') selected @endif>Canine</option>
					<option @if($patient->specie=='Feline') selected @endif>Feline</option>
					</select>
				</div>
				<div class="form-group">
					<select  name="gender" class="form-control ">
					<option value="">Gender</option>
					<option @if($patient->gender =='Male') selected @endif>Male</option>
					<option @if($patient->gender =='Female') selected @endif>Female</option>
					<option @if($patient->gender =='Neutered') selected @endif>Neutered (Male)</option>
					<option @if($patient->gender =='Spayed') selected @endif>Spayed (Female)</option>
					</select>
				</div>
				<div class="form-group"><input type="text" name="markings" class="form-control " placeholder="markings" value="{{$patient->markings}}" ></div>
				<div class="form-group"><input type="text" name="special_considerations" class="form-control " placeholder="Special Considerations (Allergues,Surgeries,etc.)" value="{{$patient->special_considerations}}" ></div>
				<div class="form-group"><input type="text" name="veterinarian" class="form-control " placeholder="Attending Veterinarian" value="{{$patient->veterinarian}}" ></div>
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>

			</form>
		</div>
	</div>
</div>
@endsection
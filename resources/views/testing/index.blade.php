@extends('layouts.app')
@section('title',$title)
@section('content')


<div class="row">
    <div class="col-md-12 form-group">
        <span class="float-left"><a href="/dashboard/client" class="btn btn-default">Go Back</a></span>
    </div>
    <div class="col-md-4">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="https://vetassist.s3-ap-southeast-1.amazonaws.com/{{Auth::user()->image}}"
                   alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ucfirst($client->name)}}</h3>

            <p class="text-muted text-center">{{ucfirst($client->occupation)}}</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Gender</b> <a class="float-right">{{ucfirst($client->gender)}}</a>
              </li>
              <li class="list-group-item">
                <b>Contact</b> 
                <br>Mobile <a class="float-right">{{$client->contact}}</a>
                <br>Work <a class="float-right">{{$client->work}}</a>
                <br>Home <a class="float-right">{{$client->home}}</a>
              </li>
              <li class="list-group-item">
                <b>Address</b><br><textarea class="form-control" readonly>{{ucfirst($client->address)}}</textarea>
              </li>
            </ul>
<!-- 
            <a href="#" class="btn btn-primary btn-block"><b>Update</b></a> -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

     <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <div class="float-left">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" onclick="choice(1);" href="#patients" data-toggle="tab">Manage Patient</a></li>
                      <li class="nav-item"><a class="nav-link" onclick="choice(2);" href="#appointment" data-toggle="tab">Manage Appointment</a></li>
                      <li class="nav-item"><a class="nav-link" onclick="choice(3);"  href="#billing" data-toggle="tab">Manage Billing</a></li>
                    </ul>
                </div>
                <div class="float-right"><button id="add_btn" class="btn btn-default"> New Patient</button></div>
            </div>
            <div class="card-body">
               <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="patients" role="tabpanel" aria-labelledby="home-tab">
                    
                    <div id="mytable" class="table-responsive">
                        <table id="table2" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Breed</th>
                                    <th>Species</th>
                                    <th>Gender</th>
                                    <th>Veterinarian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($patients))
                        @foreach($patients as $key => $patient)
                            <tr>
                            
                                <td>{{$patient->name}}</td>
                                <td>{{$patient->breed}}</td>
                                <td>{{$patient->specie}}</td>
                                <td>{{$patient->gender}}</td>
                                <td>{{$patient->veterinarian}}</td>
                                <td width="15%">
                                    <div class="">
                                        <button id="{{$patient}}" class="btn btn_add btn-block  btn-success btn-sm btn_edit"><i class="fa fa-search"></i> </button>
                                        <button id="{{$patient}}" class="btn btn_add btn-block  btn-info btn-sm btn_edit"><i class="fa fa-edit"></i> </button>
                                        
                                        <button id="{{$patient->id}}" class="btn btn-danger btn-sm btn-block  btn_delete"><i class="fa fa-trash"></i> </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else

                    @endif
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="profile-tab">
                     ...2
                    </div>
                    <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="contact-tab">
                        ...3
                    </div>
               </div>
            </div>
        </div>
    </div>
    
</div>




@endsection
@section('script')
<script type="text/javascript">
   function choice(tab){
    if(tab == 1){
        $('#add_btn').html('New Patient');
    }else if(tab == 2){
        $('#add_btn').html('New Appointment');
    }else if(tab == 3){
        $('#add_btn').html('New Billing');
    }

   }
</script>
@endsection
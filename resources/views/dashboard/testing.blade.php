@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="col-md-6 mx-auto">
  <!-- time Picker -->
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="timepicker" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#timepicker"/>
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
</div>

{{ Form::label('dogs', 'Dogs') }}
{{ Form::select('dogs[]', ['name'=>'max','name'=>'jade'], null, ['id' => 'dogs', 'multiple' => 'multiple']) }}

@endsection
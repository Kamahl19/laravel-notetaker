@extends('master')

@section('content')

  <div class="main-form">
  
		@if( count($errors) > 0 )
			<div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
		@endif

    {{ Form::open(array('url' => 'team', 'class'=>'form-horizontal' )) }}
    
  		<div class="form-group">
        {{ Form::label('name', trans('common.title'), array('class' => 'sr-only col-sm-2')) }}
        <div class="col-sm-12">
          {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => trans('common.title'), 'required' => 'required', 'autofocus' => 'autofocus')) }}
        </div>
  		</div>
      
      <div class="form-group">
        {{ Form::label('email', trans('common.email'), array('class' => 'sr-only col-sm-2')) }}
        <div class="col-sm-12">
          {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => trans('common.email'), 'required' => 'required')) }}
        </div>
  		</div>
  
      {{ Form::submit(trans('common.save'), array('class' => 'btn btn-primary btn-sm')) }}
      
    {{ Form::close() }}
		    
  </div>   
  
@stop
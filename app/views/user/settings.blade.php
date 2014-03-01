@extends('master')

@section('content')
        
  <div class="main-form">
  
    @if( count($errors) > 0 )
			<div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
		@endif
               
    {{ Form::model($user, array('route' => array('user.settings'), 'method' => 'POST', 'class' => 'form-horizontal')) }}
    
      <div class="form-group">
        {{ Form::label('email', trans('confide::confide.e_mail'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'email', 'placeholder' => trans('confide::confide.e_mail'), 'required' => 'required')) }}
        </div>
  		</div>
      
      <!--
      <div class="form-group">
        {{ Form::label('password', trans('confide::confide.password'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => trans('confide::confide.password'))) }}
        </div>
  		</div>
      
      <div class="form-group">
        {{ Form::label('password_confirmation', trans('confide::confide.password_confirmation'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => trans('confide::confide.password_confirmation'))) }}
        </div>
  		</div>
      -->
      
      <div class="form-group">
        {{ Form::label('timezone', trans('common.timezone'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::select('timezone', Functions::timezone_list(), null, array('class' => 'form-control', 'required' => 'required')) }}
        </div>
  		</div>
      
      <div class="form-group">
        {{ Form::label('language', trans('common.language'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::select('language', Functions::language_list(), null, array('class' => 'form-control', 'required' => 'required')) }}
        </div>
  		</div>

      <!-- {{ Form::hidden('_token', Session::getToken()) }} -->
      
      <div class="form-group no-bottom-margin">
        {{ Form::label('', '', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::submit(trans('common.save'), array('class' => 'btn btn-primary btn-sm')) }} 
        </div>
  		</div>    
           
    {{ Form::close() }}
  
  </div>
    
@stop
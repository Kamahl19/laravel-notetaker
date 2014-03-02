@extends('master')

@section('content')
        
  <div class="main-form">    
    
    @if( count($errors) > 0 )
			<div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
		@endif

    <form method="POST" action="{{ (Confide::checkAction('UserController@do_forgot_password')) ?: URL::to('/user/forgot') }}" class="form-horizontal" accept-charset="UTF-8">
    
      <div class="form-group">
        {{ Form::label('email', trans('confide::confide.e_mail'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'id' => 'email', 'placeholder' => trans('confide::confide.e_mail'), 'required' => 'required', 'autofocus' => 'autofocus')) }}
        </div>
  		</div>
    
      {{ Form::hidden('_token', Session::getToken()) }}
      
      <div class="form-group no-bottom-margin">
        {{ Form::label('', '', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::submit(trans('confide::confide.signup.submit'), array('class' => 'btn btn-primary btn-sm')) }} 
        </div>
  		</div>    
           
    </form>
  
  </div>      
    
@stop
@extends('master')

@section('content')
        
  <div class="main-form">    
    
    @if ( Session::get('error') )
      <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
    @endif

    @if ( Session::get('notice') )
      <div class="alert">{{{ Session::get('notice') }}}</div>
    @endif
  
    <form method="POST" action="{{{ (Confide::checkAction('UserController@do_reset_password')) ?: URL::to('/user/reset') }}}" class="form-horizontal" accept-charset="UTF-8">
    
      <div class="form-group">
        {{ Form::label('password', trans('confide::confide.password'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => trans('confide::confide.password'), 'required' => 'required', 'autofocus' => 'autofocus')) }}
        </div>
  		</div>
      
      <div class="form-group">
        {{ Form::label('password_confirmation', trans('confide::confide.password_confirmation'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => trans('confide::confide.password_confirmation'), 'required' => 'required')) }}
        </div>
  		</div>
      
      {{ Form::hidden('token', $token) }}
      {{ Form::hidden('_token', Session::getToken()) }}
      
      <div class="form-group">
        {{ Form::label('', '', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::submit(trans('confide::confide.signup.submit'), array('class' => 'btn btn-primary btn-sm')) }} 
        </div>
  		</div>    
           
      <div class="clearfix"></div>
      
    </form>
  
  </div>      
    
@stop
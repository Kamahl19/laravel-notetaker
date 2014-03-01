@extends('master')

@section('content')
        
  <div class="main-form">
  
    @if ( Session::get('error') )
      <div class="alert alert-danger">
        @if ( is_array(Session::get('error')) )
          {{ head(Session::get('error')) }}
        @endif
      </div>
    @endif

    @if ( Session::get('notice') )
      <div class="alert">{{ Session::get('notice') }}</div>
    @endif
               
    <form method="POST" action="{{{ (Confide::checkAction('UserController@store')) ?: URL::to('user')  }}}" class="form-horizontal" accept-charset="UTF-8">
    
      <div class="form-group">
        {{ Form::label('username', trans('confide::confide.username'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'id' => 'username', 'placeholder' => trans('confide::confide.username'), 'required' => 'required', 'autofocus' => 'autofocus')) }}
        </div>
  		</div>
      
      <div class="form-group">
        {{ Form::label('email', trans('confide::confide.e_mail'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'id' => 'email', 'placeholder' => trans('confide::confide.e_mail'), 'required' => 'required')) }}
        </div>
  		</div>
      
      <div class="form-group">
        {{ Form::label('password', trans('confide::confide.password'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => trans('confide::confide.password'), 'required' => 'required')) }}
        </div>
  		</div>
      
      <div class="form-group">
        {{ Form::label('password_confirmation', trans('confide::confide.password_confirmation'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => trans('confide::confide.password_confirmation'), 'required' => 'required')) }}
        </div>
  		</div>
      
      <div class="form-group">
        {{ Form::label('timezone', trans('common.timezone'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::select('timezone', Functions::timezone_list(), Input::old('timezone'), array('class' => 'form-control', 'required' => 'required')) }}
        </div>
  		</div>
      
      <div class="form-group">
        {{ Form::label('language', trans('common.language'), array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
          {{ Form::select('language', Functions::language_list(), Input::old('language'), array('class' => 'form-control', 'required' => 'required')) }}
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
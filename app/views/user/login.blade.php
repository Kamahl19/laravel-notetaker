@extends('master')

@section('content')
        
  <div class="login-form col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
  
    @if( count($errors) > 0 )
			<div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
		@endif
    
    @if ( Session::get('notice') )
      <div class="alert alert-info">{{{ Session::get('notice') }}}</div>
    @endif
               
    <form method="POST" action="{{{ Confide::checkAction('UserController@do_login') ?: URL::to('/user/login') }}}" class="form-horizontal" accept-charset="UTF-8">
    
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-user fa-fw fa-lg"></span></span>
        {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'id' => 'email', 'placeholder' => trans('confide::confide.username_e_mail'), 'required' => 'required', 'autofocus' => 'autofocus')) }}
      </div>
      
      <div class="input-group">
        <span class="input-group-addon"><span class="fa fa-lock fa-fw fa-lg"></span></span>
        {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => trans('confide::confide.password'), 'required' => 'required')) }}
      </div>
          
      <div class="pull-right forgot-password">
        <a href="{{{ (Confide::checkAction('UserController@forgot_password')) ?: 'forgot' }}}">{{{ trans('confide::confide.login.forgot_password') }}}</a>
      </div>
      
      <div class="checkbox">
        <label>
          <input type="hidden" name="remember" value="0">             
          <input type="checkbox" name="remember" id="remember" value="1"> {{{ trans('confide::confide.login.remember') }}}
        </label>
      </div>
    
      {{ Form::hidden('_token', Session::getToken()) }}
      
      {{ Form::submit(trans('confide::confide.login.submit'), array('class' => 'btn btn-primary btn-sm')) }} 
        
    </form>  
    
  </div>
  
  <div class="clearfix"></div>
    
@stop
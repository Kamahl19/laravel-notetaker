<?php

class UserController extends BaseController {

  /**
   * Displays the form for account creation
   */
  public function create()
  {
    return View::make('user.signup');
  }

  /**
   * Stores new account
   */
  public function store()
  {
    $user = new User;

    $user->username               = Input::get('username');
    $user->email                  = Input::get('email');
    $user->password               = Input::get('password');
    $user->password_confirmation  = Input::get('password_confirmation');
    $user->timezone               = Input::get('timezone');
    $user->language               = Input::get('language');

    $user->save();

    if ($user->id)
    {
      return Redirect::action('UserController@login')
                      ->with('notice', trans('confide::confide.alerts.account_created'));
    }
    else
    {
      $error = $user->errors()->all(':message');

      return Redirect::action('UserController@create')
                      ->withInput(Input::except('password'))
                      ->with('error', $error);
    }
  }

  /**
   * Displays the login form
   */
  public function login()
  {
    if ( Confide::user() )
    {
      return Redirect::to('/');
    }
    else
    {
      return View::make('user.login');
    }
  }

  /**
   * Attempt to do login
   */
  public function do_login()
  {
    $input = array(
      'email'    => Input::get('email'), // may be also username
      'username' => Input::get('email'),
      'password' => Input::get('password'),
      'remember' => Input::get('remember'),
    );

    if ( Confide::logAttempt($input, Config::get('confide::signup_confirm')) ) 
    {
      return Redirect::intended('/');
    }
    else
    {
      $user = new User;

      // Check if there was too many login attempts
      if ( Confide::isThrottled($input) )
      {
        $err_msg = trans('confide::confide.alerts.too_many_attempts');
      }
      else if ( $user->checkUserExists($input) && !$user->isConfirmed($input) )
      {
        $err_msg = trans('confide::confide.alerts.not_confirmed');
      }
      else
      {
        $err_msg = trans('confide::confide.alerts.wrong_credentials');
      }

      return Redirect::action('UserController@login')
                      ->withInput(Input::except('password'))
                      ->with('error', $err_msg);
    }
  }

  /**
   * Attempt to confirm account with code
   *
   * @param  string  $code
   */
  public function confirm($code)
  {
    if ( Confide::confirm($code) )
    {
      $notice_msg = trans('confide::confide.alerts.confirmation');
      return Redirect::action('UserController@login')
                      ->with('notice', $notice_msg);
    }
    else
    {
      $error_msg = trans('confide::confide.alerts.wrong_confirmation');
      return Redirect::action('UserController@login')
                      ->with('error', $error_msg);
    }
  }

  /**
   * Displays the forgot password form
   */
  public function forgot_password()
  {
    return View::make('user.forgot_password');
  }

  /**
   * Attempt to send change password link to the given email
   */
  public function do_forgot_password()
  {
    if ( Confide::forgotPassword( Input::get('email') ) )
    {
      $notice_msg = trans('confide::confide.alerts.password_forgot');
      return Redirect::action('UserController@login')
                      ->with('notice', $notice_msg);
    }
    else
    {
      $error_msg = trans('confide::confide.alerts.wrong_password_forgot');
      return Redirect::action('UserController@forgot_password')
                      ->withInput()
                      ->with('error', $error_msg);
    }
  }

  /**
   * Shows the change password form with the given token
   */
  public function reset_password($token)
  {
    return View::make('user.reset_password')
                ->with('token', $token);
  }

  /**
   * Attempt change password of the user
   */
  public function do_reset_password()
  {
    $input = array(
      'token'                 => Input::get('token'),
      'password'              => Input::get('password'),
      'password_confirmation' => Input::get('password_confirmation'),
    );

    if( Confide::resetPassword($input) )
    {
      $notice_msg = trans('confide::confide.alerts.password_reset');
      return Redirect::action('UserController@login')
                      ->with('notice', $notice_msg);
    }
    else
    {
      $error_msg = trans('confide::confide.alerts.wrong_password_reset');
      return Redirect::action('UserController@reset_password', array('token' => $input['token']))
                      ->withInput()
                      ->with('error', $error_msg);
    }
  }

  /**
   * Log the user out of the application.
   */
  public function logout()
  {
    Confide::logout();
    
    return Redirect::to('/');
  }
  
  /**
   * Shows the settings form
   */
  public function settings()
  {
    return View::make('user.settings')
                ->with('user', Confide::User());
  }

  /**
   * Attempt change settings of the user
   */
  public function do_settings()
  {           
   
  }

}

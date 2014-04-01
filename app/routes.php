<?php
        
Route::group(array('before' => 'auth'), function()
{
  Route::get('/', function()
  {
    return Redirect::to('notes');
  });
  
  Route::resource('notes',                          'NoteController');
  
  Route::resource('categories',                     'CategoryController');    
  
  Route::resource('team',                     'TeamController');    
  
  Route::get('attachments/{attachments}',           'AttachmentController@get_attachments');
  Route::get('attachments/download/{attachments}',  'AttachmentController@download');
  Route::post('attachments/store',                  'AttachmentController@store');  
  Route::delete('attachments/{attachments}',        'AttachmentController@destroy');
  
  Route::get('user/settings',                       'UserController@settings');
  Route::post('user/settings',                      array('as' => 'user.settings', 'uses' => 'UserController@do_settings'), function(){});
  Route::post('user/change_password',               array('as' => 'user.change_password', 'uses' => 'UserController@change_password'), function(){});
  Route::post('user/delete',                        'UserController@destroy');
});                
  
Route::get( 'user/create',                 'UserController@create');
Route::post('user',                        'UserController@store');
Route::get( 'user/login',                  'UserController@login');
Route::post('user/login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( 'user/logout',                 'UserController@logout');

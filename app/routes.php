<?php

Route::get('/', function()
{
    return Redirect::to('notes');
});

Route::resource('notes', 'NoteController');

Route::resource('categories', 'CategoryController');    

Route::post('attachments/store', 'AttachmentController@store');  
Route::delete('attachments/{attachments}', 'AttachmentController@destroy');
Route::get('attachments/{attachments}', 'AttachmentController@get_attachments');

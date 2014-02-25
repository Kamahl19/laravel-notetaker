<?php

Route::get('/', function()
{
    return Redirect::to('notes');
});

Route::resource('notes', 'NoteController');

Route::resource('categories', 'CategoryController');    

Route::get('attachments/{attachments}', 'AttachmentController@get_attachments');
Route::get('attachments/download/{attachments}', 'AttachmentController@download');
Route::post('attachments/store', 'AttachmentController@store');  
Route::delete('attachments/{attachments}', 'AttachmentController@destroy');

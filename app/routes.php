<?php

Route::get('/', function()
{
    return Redirect::to('notes');
});

Route::resource('notes', 'NoteController');

Route::post('notes/upload', 'NoteController@upload');  

Route::resource('categories', 'CategoryController');

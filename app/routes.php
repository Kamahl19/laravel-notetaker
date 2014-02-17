<?php

Route::get('/', 'NoteController@index');

Route::get('/', function()
{
    return Redirect::to('notes');
});

Route::resource('notes', 'NoteController');

Route::resource('categories', 'CategoryController');

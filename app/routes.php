<?php

Route::get('/', 'NoteController@index');

Route::resource('notes', 'NoteController');

Route::resource('categories', 'CategoryController');

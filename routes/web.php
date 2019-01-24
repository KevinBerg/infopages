<?php

Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::resource('pages', 'PageController');
Route::resource('contents', 'ContentController');

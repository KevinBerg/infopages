<?php

Route::get('/', function () {
    return redirect('/pages');
});

Auth::routes();
Route::resource('pages', 'PageController')->middleware('auth');
Route::resource('contents', 'ContentController')->middleware('auth');
Route::get('render/{pageTitle}', 'RenderController@render');

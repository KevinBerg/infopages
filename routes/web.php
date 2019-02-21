<?php

Route::get('/', function () {
    $pages = \App\Page::all();
    return view('urls.show', compact('pages'));
});

Auth::routes();
Route::resource('pages', 'PageController')->middleware('auth');
Route::resource('contents', 'ContentController')->middleware('auth');
Route::get('contents/{content}/preview', 'ContentController@preview')->middleware('auth');
Route::get('render/{pageTitle}', 'RenderController@render');

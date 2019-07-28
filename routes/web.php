<?php

Route::get('/', 'Pub\MainController@index')->name('home');
Route::get('/suggest', 'Pub\MainController@suggest')->name('suggest');
Route::get('/api_doc', 'Pub\MainController@api_doc')->name('api_doc');


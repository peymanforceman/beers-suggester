<?php

Route::group(['prefix' => 'v1'], function () {

    Route::get('/update', 'API\BeerController@update_beers')->name('update_beers_request');
    Route::any('/suggest', 'API\BeerController@suggest_beers')->name('api_suggest_beers');
});
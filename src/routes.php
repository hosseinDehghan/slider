<?php
Route::group(['middleware' => ['web']], function () {
    Route::get("slider", "Hosein\Sliders\Controllers\SlidersController@index");
    Route::get("slider/edit/{id}", "Hosein\Sliders\Controllers\SlidersController@edit");
    Route::get("slider/delete/{id}", "Hosein\Sliders\Controllers\SlidersController@delete");
    Route::post("slider/create", "Hosein\Sliders\Controllers\SlidersController@create");
    Route::post("slider/update/{id}", "Hosein\Sliders\Controllers\SlidersController@update");
});

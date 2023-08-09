<?php

Route::namespace('Admin')->group(function () {
Route::get('banner','BannerController@index')->name('banner');
Route::post('banner/add','BannerController@store')->name('banner/add');
Route::get('banner/destroy/{id}','BannerController@destroy')->name('banner/destroy/{id}');
Route::get('banner/edit/{id}','BannerController@edit');
Route::post('banner/update','BannerController@update');

});
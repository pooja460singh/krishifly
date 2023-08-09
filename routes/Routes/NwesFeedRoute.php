<?php

Route::namespace('Admin')->group(function () {
Route::get('newsfeed','NewsFeedController@index')->name('newsfeed');
Route::post('newsfeed/add','NewsFeedController@add_newsfeed')->name('newsfeed/add');
Route::get('newsfeed/show/{id}','NewsFeedController@show_NewsFeedImage');
Route::get('newsfeed/destroy/{id}','NewsFeedController@destroy')->name('newsfeed/destroy/{id}');
Route::get('newsfeed/edit/{id}','NewsFeedController@edit_newsfeed');
Route::post('newsfeed/update','NewsFeedController@update');
Route::get('newsimage/edit/{id}','NewsFeedController@newsimage_edit')->name('newsimage/edit');
Route::post('newsfeedimage/update','NewsFeedController@newsimage_update')->name('newsfeedimage/update');

Route::get('newsfeed/image/edit/{id}','NewsFeedController@editNewsImage')->name('newsfeed/image/edit');
Route::post('newsfeed/image/add','NewsFeedController@addProductImage')->name('newsfeed/image/add');

});
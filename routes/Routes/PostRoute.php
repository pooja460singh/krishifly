<?php

Route::namespace('Admin')->group(function () {
Route::get('post','PostController@index')->name('post');
Route::post('post/add','PostController@add_Post')->name('post/add');
Route::get('post/destroy/{id}','PostController@destroy')->name('post/destroy/{id}');
Route::get('post/edit/{id}','PostController@edit_Post');
Route::post('post/update','PostController@update_Post');
Route::get('post/show/{id}','PostController@show_PostImage');
Route::get('postimage/edit/{id}','PostController@postimage_edit')->name('postimage/edit');
Route::post('postimage/update','PostController@postimage_update')->name('postimage/update');

Route::get('post/image/edit/{id}','PostController@editPostImage')->name('post/image/edit');
Route::post('post/image/add','PostController@addProductImage')->name('post/image/add');
});
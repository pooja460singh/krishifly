<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
foreach (File::allFiles(__DIR__ . '/Routes') as $partial) {
    require (string)$partial;
}

Route::get('/', function () {
    return view('admin.index');
});
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('admin/login', 'Auth\LoginController@adminlogin')->name('admin/login');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('API')->group(function () {
Route::post('/post', 'PostController@add_post')->name('post');
Route::get('/feed', 'PostController@post_list')->name('feed');
Route::post('/search', 'PostController@search_post')->name('/search');
Route::post('otp/generator', 'LoginController@otp_generator')->name('otp/generator');
Route::post('otp/verify', 'LoginController@verify_otp')->name('otp/verify');
Route::post('update/profile', 'ProfileController@update_profile')->name('update/profile');
Route::post('rating', 'PostController@update_rating')->name('rating');
Route::post('update/kyc-bank-detail', 'ProfileController@kyc_bank_update')->name('update/kyc-bank-detail');
Route::post('get/user-detail', 'UserController@get_user')->name('get/user-detail');

Route::post('whishlist/add', 'WishlistController@add_wishlist')->name('whishlist/add');
Route::post('whishlist/details', 'WishlistController@get_wishlist')->name('whishlist/details');
Route::post('/planlist', 'PlanController@plan_list')->name('/planlist');
Route::post('/purchase-plan', 'PaymentController@add_Payment')->name('/purchase-plan');

Route::post('/product-detail', 'ProductController@add_ProductDetail')->name('/product-detail');

Route::post('change-profile-image', 'ProfileController@change_profile_image')->name('change-profile-image');
Route::get('/bannerlist', 'BannerController@banner')->name('bannerlist');

Route::post('/load-unload', 'LoadUnloadController@add_load_unload')->name('/load-unload');

Route::post('/newsfeed-like', 'NwesFeedController@add_newsfeedlike')->name('/newsfeed-like');

Route::post('/newsfeed-comment', 'CommentController@add_newsfeedcomment')->name('/newsfeed-comment');

Route::get('/news-feed', 'NwesFeedController@get_newsfeedlist')->name('/news-feed');

Route::get('/comment-list', 'CommentController@get_commentlist')->name('/comment-list');
});

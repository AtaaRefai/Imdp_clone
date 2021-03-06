<?php

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

Auth::routes();
Route::post('logout', function(){
	     Auth::logout();
         return view('auth.login');
});
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('home/', 'HomeController@index')->name('home');
    Route::get('home/{category}', 'HomeController@show')->name('home');
    Route::resource('videos', 'VideoController');
    Route::resource('comments', 'CommentController');

});


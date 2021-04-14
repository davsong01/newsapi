<?php

use Illuminate\Http\Request;

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

//uses cors and json.response middleware to ensure all responses are sent back as json
//Open endpoints
Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api'); 
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
});

//Protected endpoints
Route::middleware('auth:api')->group(function () {
    Route::resource('articles', 'ArticleController');
    Route::get('writers', 'WriterController@index');
    Route::get('myarticles', 'WriterController@myarticles');
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
});


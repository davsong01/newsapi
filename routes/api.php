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
Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api'); 
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
});

Route::middleware('auth:api')->group(function () {
    Route::resource('articles', 'ArticleController');
    Route::get('writers', 'WriterController@index');
    Route::get('myarticles', 'WriterController@myarticles');
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

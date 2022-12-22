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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['check.user']], function () {
    Route::get('cuadros/{cuadro}', 'CuadroController@show')->name('api.v1.cuadros.show');
    Route::get('cuadros', 'CuadroController@index')->name('api.v1.cuadros.index');
    Route::post('cuadros', 'CuadroController@create')->name('api.v1.cuadros.create');
    Route::put('cuadros/{cuadro}', 'CuadroController@update')->name('api.v1.cuadros.update');
    Route::delete('cuadros/{cuadro}', 'CuadroController@delete')->name('api.v1.cuadros.delete');
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/**
 * Items Resource
 */
Route::resource('items', \App\Http\Controllers\API\ItemController::class);
/**
 * User auth login & register
 */
Route::post('login',[\App\Http\Controllers\API\UserController::class,'login']);
Route::post('register',[\App\Http\Controllers\API\UserController::class,'register']);

Route::group(['middleware' => 'auth:api'], function () {
/**
 * Order Resource
 */
    Route::resource('order', \App\Http\Controllers\API\OrderController::class);
});

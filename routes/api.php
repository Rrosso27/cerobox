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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('App\\Http\\Controllers')->group(function () {
    //UsersController
    Route::controller(CustomersController::class)->group(function () {
        // Route::middleware(['first', 'customers'])->group(function () {
            Route::post('create','validator');
            Route::delete('/delecte/{id}','delecte');

        // });
    });
    
});

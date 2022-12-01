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

Route::get('student',[App\Http\Controllers\ApiController::class, 'read']);
Route::get('student/{id}',[App\Http\Controllers\ApiController::class, 'show']);

Route::post('student',[App\Http\Controllers\ApiController::class, 'create']);

Route::put('student/{id}/update',[App\Http\Controllers\ApiController::class, 'update']);

Route::delete('student/{id}/delete',[App\Http\Controllers\ApiController::class, 'delete']);

<?php

use App\Http\Controllers\Backend\AdministratorController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\HomeController;
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
Route::group(['prefix' => 'admin'], function () {
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/dashboard', [HomeController::class, 'dashboard']);
        Route::get('/administrator/info', [AdministratorController::class, 'info']);
    });
});

<?php

use App\Http\Controllers\Backend\AdministratorController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\HomeController;
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

        Route::group(['prefix' => 'administrator'], function (){
            Route::get('/info', [AdministratorController::class, 'info']);
            Route::get('/list', [AdministratorController::class, 'list']);
            Route::get('/{administrator}', [AdministratorController::class, 'detail'])->where('administrator', '[0-9]+');
            Route::post('/store', [AdministratorController::class, 'store']);
            Route::post('/{administrator}/update', [AdministratorController::class, 'update'])->where('administrator', '[0-9]+');
            Route::delete('/{administrator}', [AdministratorController::class, 'delete'])->where('administrator', '[0-9]+');
        });

        Route::group(['prefix' => 'category'], function (){
            Route::get('/list', [CategoryController::class, 'list']);
            Route::get('/parents', [CategoryController::class, 'parents']);
            Route::get('/{category}', [CategoryController::class, 'detail'])->where('category', '[0-9]+');
            Route::post('/store', [CategoryController::class, 'store']);
            Route::post('/{category}/update', [CategoryController::class, 'update'])->where('category', '[0-9]+');
            Route::delete('/{category}', [CategoryController::class, 'delete'])->where('category', '[0-9]+');
        });

        Route::group(['prefix' => 'tag'], function (){
            Route::get('/list', [TagController::class, 'list']);
            Route::get('/{tag}', [TagController::class, 'detail'])->where('tag', '[0-9]+');
            Route::post('/store', [TagController::class, 'store']);
            Route::post('/{tag}/update', [TagController::class, 'update'])->where('tag', '[0-9]+');
            Route::delete('/{tag}', [TagController::class, 'delete'])->where('tag', '[0-9]+');
        });

        Route::group(['prefix' => 'setting'], function (){
            Route::get('/{key}', [SettingController::class, 'info']);
            Route::post('/{key}/update', [SettingController::class, 'update']);
        });
    });
});

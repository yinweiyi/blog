<?php

use App\Http\Controllers\Backend\AdministratorController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\FileController;
use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Backend\ImageModelController;
use App\Http\Controllers\Backend\SentenceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\FriendshipController;
use App\Http\Controllers\Backend\ArticleController;
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
        Route::post('/file/upload', [FileController::class, 'upload']);

        Route::group(['prefix' => 'administrator'], function () {
            Route::get('/info', [AdministratorController::class, 'info']);
            Route::get('/list', [AdministratorController::class, 'list']);
            Route::get('/{administrator}', [AdministratorController::class, 'detail'])->where('administrator', '[0-9]+');
            Route::post('/store', [AdministratorController::class, 'store']);
            Route::post('/{administrator}/update', [AdministratorController::class, 'update'])->where('administrator', '[0-9]+');
            Route::delete('/{administrator}', [AdministratorController::class, 'delete'])->where('administrator', '[0-9]+');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/list', [CategoryController::class, 'list']);
            Route::get('/parents', [CategoryController::class, 'parents']);
            Route::get('/{category}', [CategoryController::class, 'detail'])->where('category', '[0-9]+');
            Route::post('/store', [CategoryController::class, 'store']);
            Route::post('/{category}/update', [CategoryController::class, 'update'])->where('category', '[0-9]+');
            Route::delete('/{category}', [CategoryController::class, 'delete'])->where('category', '[0-9]+');
        });

        Route::group(['prefix' => 'tag'], function () {
            Route::get('/list', [TagController::class, 'list']);
            Route::get('/all', [TagController::class, 'all']);
            Route::post('/store', [TagController::class, 'store']);
            Route::post('/{tag}/update', [TagController::class, 'update'])->where('tag', '[0-9]+');
            Route::delete('/{tag}', [TagController::class, 'delete'])->where('tag', '[0-9]+');
        });

        Route::group(['prefix' => 'article'], function () {
            Route::get('/list', [ArticleController::class, 'list']);
            Route::get('/{article}', [ArticleController::class, 'detail'])->where('article', '[0-9]+');
            Route::post('/store', [ArticleController::class, 'store']);
            Route::post('/{article}/update', [ArticleController::class, 'update'])->where('article', '[0-9]+');
            Route::post('/{article}/update-status', [ArticleController::class, 'updateStatus'])->where('article', '[0-9]+');
            Route::delete('/{article}', [ArticleController::class, 'delete'])->where('article', '[0-9]+');
        });

        Route::group(['prefix' => 'friendship'], function () {
            Route::get('/list', [FriendshipController::class, 'list']);
            Route::get('/{friendship}', [FriendshipController::class, 'detail'])->where('friendship', '[0-9]+');
            Route::post('/store', [FriendshipController::class, 'store']);
            Route::post('/{friendship}/update', [FriendshipController::class, 'update'])->where('friendship', '[0-9]+');
            Route::post('/{friendship}/update-status', [FriendshipController::class, 'updateStatus'])->where('friendship', '[0-9]+');
            Route::delete('/{friendship}', [FriendshipController::class, 'delete'])->where('friendship', '[0-9]+');
        });

        Route::group(['prefix' => 'setting'], function () {
            Route::get('/{key}', [SettingController::class, 'info']);
            Route::post('/{key}/update', [SettingController::class, 'update']);
        });

        Route::group(['prefix' => 'sentence'], function () {
            Route::get('/list', [SentenceController::class, 'list']);
            Route::get('/{sentence}', [SentenceController::class, 'detail'])->where('sentence', '[0-9]+');
            Route::post('/store', [SentenceController::class, 'store']);
            Route::post('/{sentence}/update', [SentenceController::class, 'update'])->where('sentence', '[0-9]+');
            Route::delete('/{sentence}', [SentenceController::class, 'delete'])->where('sentence', '[0-9]+');
        });

        Route::group(['prefix' => 'comment'], function () {
            Route::get('/list', [CommentController::class, 'list']);
            Route::post('/reply', [CommentController::class, 'reply']);
        });

        Route::group(['prefix' => 'image-model'], function () {
            Route::get('/list', [ImageModelController::class, 'list']);
            Route::get('/{image_model}', [ImageModelController::class, 'detail'])->where('image_model', '[0-9]+');
            Route::post('/store', [ImageModelController::class, 'store']);
            Route::post('/{image_model}/update', [ImageModelController::class, 'update'])->where('image_model', '[0-9]+');
            Route::post('/{image_model}/update-status', [ImageModelController::class, 'updateStatus'])->where('image_model', '[0-9]+');
            Route::delete('/{image_model}', [ImageModelController::class, 'delete'])->where('image_model', '[0-9]+');
        });

        Route::group(['prefix' => 'image'], function () {
            Route::get('/list', [ImageController::class, 'list']);
            Route::get('/{image}', [ImageController::class, 'detail'])->where('image', '[0-9]+');
            Route::post('/store', [ImageController::class, 'store']);
            Route::post('/{image}/update', [ImageController::class, 'update'])->where('image', '[0-9]+');
            Route::delete('/{image}', [ImageController::class, 'delete'])->where('image', '[0-9]+');
        });
    });
});

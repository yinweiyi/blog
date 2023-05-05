<?php

use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\CaptchaController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ImageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/test', [HomeController::class, 'test'])->name('home.test');
Route::get('/category/{category:slug}', [HomeController::class, 'category'])->where('category', '[\d\w-]{1,50}')->name('home.index_category');
Route::get('/tag/{tag:slug}', [HomeController::class, 'tag'])->where('tag', '[\d\w-]{1,50}')->name('home.index_tag');

Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/guestbook', [HomeController::class, 'guestbook'])->name('home.guestbook');

Route::get('/articles/{slug}', [ArticleController::class, 'show'])->where('slug', '[\d\w-]{1,50}')->name('article.show');

Route::get('/image', [ImageController::class, 'index'])->name('image.index');
Route::get('/image/list', [ImageController::class, 'list'])->name('image.list');
Route::post('/image/like', [ImageController::class, 'like'])->name('image.like');

Route::get('/captcha', [CaptchaController::class, 'captcha'])->name('captcha');

Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

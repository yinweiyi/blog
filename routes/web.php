<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\CommentController;
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
Route::get('/category/{category:slug}', [HomeController::class, 'category'])->where('category', '[\d\w-]{1,50}')->name('home.index_category');
Route::get('/tag/{tag:slug}', [HomeController::class, 'tag'])->where('tag', '[\d\w-]{1,50}')->name('home.index_tag');

Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/guestbook', [HomeController::class, 'guestbook'])->name('home.guestbook');

Route::get('/articles/{slug}', [ArticleController::class, 'show'])->where('slug', '[\d\w-]{1,50}')->name('article.show');

Route::get('/captcha', [CaptchaController::class, 'captcha'])->name('captcha');

Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

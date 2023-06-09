<?php

use App\Http\Controllers\Open\OfaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ofa'], function () {
    Route::get('/receive', [OfaController::class, 'auth']);
    Route::post('/receive', [OfaController::class, 'receive']);
});

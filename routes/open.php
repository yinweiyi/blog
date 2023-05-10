<?php

use App\Http\Controllers\Open\OfaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ofa'], function () {
    Route::any('receive', [OfaController::class, 'receive']);
});

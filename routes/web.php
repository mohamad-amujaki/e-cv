<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CvController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [CvController::class, 'show'])->name('cv.show');

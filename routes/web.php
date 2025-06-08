<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CvController;
use FontLib\Table\Type\cvt;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cv', [CvController::class, 'show'])->name('cv.show');

Route::get('/cv-load', [CvController::class,'loadData'])->name('cv.loadData');

Route::get('/cv-load-json', [CvController::class,'loadDataJson'])->name('cv.loadDataJson');

Route::get('/cv/download', [CvController::class,'previewCvPdf'])->name('cv.download');

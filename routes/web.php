<?php

use Illuminate\Support\Facades\Route;
use Ewvlnet\Dropzone\Http\Controllers\Dashboard\{FileController};

/*--================================
   DASHBOARD ROUTES
=================================--*/
Route::prefix('dashboard')
    ->middleware(['web', 'auth', 'verified'])
    ->group(function () {

        Route::post('files/{id}/model/{model}/type/{type}', [FileController::class, 'store'])->name('dashboard.files.store');
        Route::delete('files/{file}', [FileController::class, 'destroy'])->name('dashboard.files.destroy');

    });
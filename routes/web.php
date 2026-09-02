<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TvrtkaController;
use App\Http\Controllers\KontaktController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\PonudaController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dealovi.kanban');
    });

    Route::patch('/dealovi/{deal}/status', [DealController::class, 'updateStatus'])->name('dealovi.update-status');

    Route::get('/dealovi/kanban', [DealController::class, 'kanban'])->name('dealovi.kanban');

    Route::post('/dealovi/{deal}/izradi-ponudu', [DealController::class, 'izradiPonudu'])->name('dealovi.izradi-ponudu');

    Route::get('/ponude/{ponuda}', [PonudaController::class, 'show'])->name('ponude.show');

    Route::get('/ponude/{ponuda}/pdf', [PonudaController::class, 'exportPdf'])->name('ponude.pdf');


    Route::resource('tvrtke', TvrtkaController::class)->parameters([
        'tvrtke' => 'tvrtka'
    ]);
    Route::resource('kontakti', KontaktController::class)->parameters([
        'kontakti' => 'kontakt'
    ]);

    Route::resource('dealovi', DealController::class)->parameters([
        'dealovi' => 'deal'
    ]);

    Route::resource('ponude', PonudaController::class)->parameters([
        'ponude' => 'ponuda'
    ]);

});

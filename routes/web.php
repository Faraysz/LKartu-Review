<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/r/{code}', [CardController::class, 'redirect'])
    ->name('cards.redirect');

Route::get('/aktivasi/{code}', [CardController::class, 'activateForm'])
    ->name('cards.activate.form');

Route::post('/aktivasi/{code}', [CardController::class, 'activate'])
    ->name('cards.activate.submit');

Route::get('/aktivasi/{code}/selesai', [CardController::class, 'activated'])
    ->name('cards.activated');

// [PROTOTYPE] Generate kartu demo — hapus/pindah ke admin dashboard nanti
Route::post('/demo/buat', [CardController::class, 'createDemo'])
    ->name('cards.demo.create');


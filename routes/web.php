<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratController;
Route::get('/', function () {
    return view('welcome');
});



Route::get('/contrat/{id}/pdf', [ContratController::class, 'generatePdf'])
    ->name('contrat.pdf');

Route::get('/contrat/{id}/ar', [ContratController::class, 'generateArabic'])
    ->name('contrat.ar');
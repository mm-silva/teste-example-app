<?php

use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

Route::post('/cadastro', [RegistroController::class, 'store'])->name('registros.store');
Route::put('/registros/{id}', [RegistroController::class, 'update'])->name('registros.update');

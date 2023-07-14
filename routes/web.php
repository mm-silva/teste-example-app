<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('cadastro', [RegistroController::class, 'create']);

Route::get('/', [RegistroController::class, 'index']);

Route::get('/registros/{id}/edit', [RegistroController::class, 'edit'])->name('registros.edit');

Route::delete('/registros/{id}', [RegistroController::class, 'destroy'])->name('registros.destroy');



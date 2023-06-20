<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegajoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/legajos/reportPDF', [App\Http\Controllers\LegajoController::class, 'generarPDF'])->name('prueba1');
Route::get('/legajos/reportPDFPaciente/{paciente_id}', [App\Http\Controllers\LegajoController::class, 'generarPDFPaciente'])->name('prueba2');



  
Route::get('/login', function () {
    return view('login');
});




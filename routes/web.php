<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegajoController;
use App\Http\Controllers\TurnoController;

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


// HISTORIAL CLINICO EN PDF
Route::get('/legajos/reportPDF', [App\Http\Controllers\LegajoController::class, 'generarPDF'])->name('prueba1');
Route::get('/legajos/reportPDFPaciente/{paciente_id}', [App\Http\Controllers\LegajoController::class, 'generarPDFPaciente'])->name('prueba2');


// TURNOS EN PDF
Route::get('/turnos/reportTurnosPDF', [App\Http\Controllers\TurnoController::class, 'generarTurnoPDF'])->name('turno1');
Route::get('/turnos/reportPDFPaciente/{paciente_id}', [App\Http\Controllers\TurnoController::class, 'generarPDFPaciente'])->name('turno2');



  
Route::get('/login', function () {
    return view('login');
});




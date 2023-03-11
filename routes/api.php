<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObraSocialController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\LoginPacienteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    // Route::post('login', [AuthController::class, 'login']);
    // Route::post('logout', [AuthController::class, 'logout']);
    // Route::post('refresh', [AuthController::class, 'refresh']);
    // Route::post('me', [AuthController::class, 'me']);
    // Route::post('register', [AuthController::class, 'register']);

    Route::post('register', [RegisterController::class, 'register']);

});


// PROBANDO GRUPO DE RUTAS PARA EL ADMINISTRADOR
Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin'

], function ($router){

    Route::post('login_admin',[LoginAdminController::class, 'login']);

    Route::resource('obras_sociales', 'ObraSocialController');

    Route::get('pacientes', [AdminController::class, 'index']);
    
    Route::put('modificar_usuario/{id}', [AdminController::class, 'update_user']);

});



// PROBANDO RUTAS PARA EL PACIENTE
Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'paciente'

], function ($router){

    Route::post('login',[LoginPacienteController::class, 'login']);
  

});


Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'user'

], function ($router){


    Route::post('profile', [UserController::class, 'me']);
    Route::post('logout', [LogoutController::class, 'logout']);
    Route::put('modificar_clave/{id}', [UserController::class, 'update_password']);

});
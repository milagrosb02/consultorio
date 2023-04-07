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
use App\Http\Controllers\PacienteController;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {


    Route::post('register', [RegisterController::class, 'register']);

    Route::post('login',[LoginPacienteController::class, 'login']);

    Route::post('logout', [LogoutController::class, 'logout']);

    Route::post('login_admin',[LoginAdminController::class, 'login']);


});


// PROBANDO GRUPO DE RUTAS PARA EL ADMINISTRADOR
Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin'

], function ($router){

    

     //Route::resource('obras_sociales', 'ObraSocialController');

    // OBRAS SOCIALES RUTAS
    Route::get('obras_sociales', [ObraSocialController::class, 'index']);
    Route::post('obras_sociales', [ObraSocialController::class, 'store']);
    Route::delete('obras_sociales/{id}', [ObraSocialController::class, 'destroy']);



    //Route::resource('pacientes', [AdministradorController::class, 'index']); // dejar la ruta con el nombre pacientes
    Route::resource('pacientes', 'AdminController')->only('index');
    Route::get('usuarios', [UserController::class, 'get_users']);

   

});



// PROBANDO RUTAS PARA EL PACIENTE
Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'paciente'

], function ($router){

    
    Route::get('datos', [PacienteController::class, 'obtener_datos']);

});


Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'user'

], function ($router){


    Route::post('profile', [UserController::class, 'me']);
    Route::put('modificar_clave/{id}', [UserController::class, 'update_password']);
    Route::put('modificar_usuario/{id}', [AdminController::class, 'update_user']);

});


// PROBANDO RUTAS PARA LA DOC
Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'doc'

], function ($router){


    Route::get('lista', [TurnoController::class, 'pacientes_index']);
   

});
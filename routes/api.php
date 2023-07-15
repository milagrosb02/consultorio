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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\LegajoController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\OdontogramaController;
use App\Models\Odontograma;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// ruta para enviar emails
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



// ruta para resetear la contraseña
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');


Route::get('obras_sociales', [PacienteController::class, 'listar_obras_sociales']);

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {


    Route::post('register', [RegisterController::class, 'register']);

    Route::post('login',[LoginPacienteController::class, 'login']);

    Route::post('logout', [LogoutController::class, 'logout']);

    Route::post('login_admin',[LoginAdminController::class, 'login']);

    


    // para restablecer la clave
    Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('reset-password', [ForgotPasswordController::class, 'reset']);


});


// PROBANDO GRUPO DE RUTAS PARA EL ADMINISTRADOR
Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin'

], function ($router){

    // OBRAS SOCIALES RUTAS
    Route::get('obras_sociales', [ObraSocialController::class, 'index']);
    Route::post('obras_sociales', [ObraSocialController::class, 'store']);
    Route::delete('obras_sociales/{id}', [ObraSocialController::class, 'destroy']);
    Route::get('usuarios/obra_social/search/{obra_social}', [ObraSocialController::class, 'buscar_obra_social']);
    
    //Route::resource('pacientes', 'AdminController')->only('index');

    Route::get('pacientes', [AdminController::class, 'obtener_pacientes']);

   
     // Buscar pacientes registrados
     Route::get('usuarios/nombre/{first_name}', [AdminController::class, 'buscar_paciente_por_nombre']);
     Route::get('usuarios/apellido/{last_name}', [AdminController::class, 'buscar_paciente_por_apellido']);
     Route::get('usuarios/busqueda/{first_name}/{last_name}', [AdminController::class, 'buscar_paciente']);
     Route::get('usuarios/obras_sociales/{obra_social}', [AdminController::class, 'buscar_paciente_por_obra_social']);
        


     Route::put('usuario/{id}', [AdminController::class, 'editar_usuario']);

     Route::get('turnos/list', [TurnoController::class, 'index']);
     Route::get('pacientes/filtrar-turnos-mes/{mes}' , [TurnoController::class, 'filtrar_turno_por_mes']);
     Route::get('pacientes/filtrar-turnos-dia/{fecha}' , [TurnoController::class, 'filtrar_turno_por_dia']);
     Route::get('turnos/pacientes/profesional/{profesional_id}', [TurnoController::class, 'ver_turno_admin']);


    Route::post('tratamientos/create', [TratamientoController::class, 'store']);
    Route::get('tratamientos/list', [TratamientoController::class, 'index']);
    Route::delete('tratamientos/delete/{id}', [TratamientoController::class, 'destroy']);
    Route::get('tratamientos/search/{tratamiento}', [TratamientoController::class, 'buscar_tratamiento']);
    Route::get('tratamientos/select', [LegajoController::class, 'listar_tratamientos']);

    Route::post('legajo/create', [LegajoController::class, 'store']);
    Route::get('legajo/list', [LegajoController::class, 'index']);
    Route::put('legajo/update/{id}', [LegajoController::class, 'update']);

    Route::post('profile', [AdminController::class, 'admin_perfil']);


    // odontograma
    Route::post('odontograma/create', [OdontogramaController::class, 'store']);
    Route::get('odontograma/list', [OdontogramaController::class, 'index']);
    Route::put('odontograma/update/{paciente_id}', [OdontogramaController::class, 'update']);
    Route::get('piezas/select', [OdontogramaController::class, 'listar_piezas_dentales']);
    Route::get('caras_dentales/select', [OdontogramaController::class, 'listar_caras_dentales']);
    Route::get('colores_anomalias/select', [OdontogramaController::class, 'listar_colores_anomalias']);

});



// PROBANDO RUTAS PARA EL PACIENTE
Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'paciente'

], function ($router){

    Route::put('email/{id}', [PacienteController::class, 'editar_email']);

    Route::put('telefono/{id}', [PacienteController::class, 'editar_telefono']);

    Route::post('turnos/create', [TurnoController::class, 'store']);

    Route::get('turnos/show/{paciente_id}', [TurnoController::class, 'show']);

    Route::get('turnos/cancelar/{turno_id}', [TurnoController::class, 'cancelar_turno']);

    Route::get('legajo/show/{paciente_id}', [LegajoController::class, 'show']);

    Route::get('profile/{paciente_id}', [PacienteController::class, 'paciente_perfil']);

    Route::get('turno/especialidad/{profesional_id}', [TurnoController::class, 'listar_especialidades']);

    Route::get('odontograma/show/{paciente_id}', [OdontogramaController::class, 'show']);

    Route::get('obra_social/select', [PacienteController::class, 'listar_obras_sociales']);


});


Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'user'

], function ($router){


    //Route::post('profile', [UserController::class, 'me']);
    Route::put('clave/{id}', [UserController::class, 'editar_clave']);
    
   

});


// PROBANDO RUTAS PARA LA DOC
Route::group([

    'namespace' => 'App\Http\Controllers',
    'prefix' => 'doc'

], function ($router){


    Route::get('pacientes/turnos/{profesional_id}', [ProfesionalController::class, 'ver_pacientes']);
    Route::get('legajo/list', [LegajoController::class, 'index']);
    Route::post('profile', [ProfesionalController::class, 'profesional_perfil']);

});

// esta ruta 
Route::get('fechas', [TurnoController::class, 'fechashorasDisponibles']);
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Paciente;
use App\Models\User;
use App\Http\Resources\PacienteResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ObraSociale;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailConfirmation;

class PacienteController extends Controller
{

    public function datos_pacientes(Request $request)
    {
        // creo una validacion de datos
        // con $request->all() tomo todos los datos que ingreso
        $validarPaciente = Validator::make($request->all(), 
        
        [

            //'user_id' => 'required',

            'phone' => 'required|numeric',

            'obra_social_id' => 'required'

        ]);

        // si la solicitud no es valida
        if($validarPaciente->fails()){

            return response()->json($validarPaciente->errors()->toJson(), 400);

        }

        // si la solicitud es valida, creo el nuevo usuario
        $paciente = Paciente::create(array_merge(
            $validarPaciente->validate()));


        return response()->json([

            'message' => '¡Estas registrado!',
            'paciente' => $paciente,
           

        ], 201);

    }

    
    
    public function editar_datos_paciente(Request $request, $paciente_id)
    {
        $paciente = Paciente::findOrFail($paciente_id);

    // Verificar si se envió el campo "telefono" y actualizar si es necesario
    if ($request->has('phone')) {
        $this->validate($request, [
            'phone' => 'required|numeric'
        ]);

        $paciente->phone = $request->phone;
    }

    // Verificar si se envió el campo "email" y actualizar si es necesario
    if ($request->has('email')) {
        $this->validate($request, [
            'email' => 'string|email|unique:users|min:6'
        ]);

        $paciente->user->email = $request->email;
        $paciente->user->save();

        // Enviar el correo de confirmación
        //Mail::to($paciente->user->email)->send(new EmailConfirmation($paciente->user));
    }

    // Guardar los cambios
    $paciente->save();

    return response()->json([
        'message' => '¡Actualizado correctamente!',
        'paciente' => $paciente
    ], 200);
    }
    
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    public function paciente_perfil($paciente_id)
    {
        //return response()->json($this->guard()->user()->load('paciente'));

        $pacientes = DB::table('users')
        ->leftJoin('pacientes', 'users.id', '=' , 'pacientes.user_id')
        ->leftJoin('obra_sociales', 'pacientes.obra_social_id', '=' , 'obra_sociales.id')
        ->select('first_name AS nombre', 'last_name AS apellido', 'phone AS telefono', 'obra_social AS obra_social')
        //->where('pacientes.user_id', '=' , $paciente_id)
        ->where('pacientes.user_id', '=' , $paciente_id) // mandar el id del paciente en react
        ->get();

        return response()->json($pacientes);

    }

   
    public function listar_obras_sociales()
    {
       return ObraSociale::select('id', 'obra_social')->get();
    }
    
}

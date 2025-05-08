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
        try {
            $validarPaciente = Validator::make($request->all(), [
                'phone' => 'required|numeric',
                'obra_social_id' => 'required'
            ]);

            if ($validarPaciente->fails()) {
                return response()->json($validarPaciente->errors()->toJson(), 400);
            }

            $paciente = Paciente::create(array_merge($validarPaciente->validate()));

            return response()->json([
                'message' => '¡Estas registrado!',
                'paciente' => $paciente,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al registrar al paciente.'], 500);
        }
    }

    
    
    public function editar_telefono(Request $request, $paciente_id)
    {
        try {
            $paciente = Paciente::findOrFail($paciente_id);

            if ($request->has('phone')) {
                $this->validate($request, [
                    'phone' => 'required|numeric'
                ]);
                $paciente->phone = $request->phone;
            }

            $paciente->save();

            return response()->json([
                'message' => '¡Número de teléfono actualizado correctamente!',
                'paciente' => $paciente
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al actualizar el teléfono.'], 500);
        }
    }
    
    

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

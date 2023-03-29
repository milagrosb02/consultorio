<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Paciente;
use App\Http\Resources\PacienteResource;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{

    public function obtener_datos()
    {

        //return PacienteResource::collection(Paciente::with('user', 'obra_social')->get());
        $pacientes = DB::table('users')
                    ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                    ->join('obra_sociales', 'obra_sociales.id' , '=', 'pacientes.obra_social_id')
                    ->select('first_name', 'last_name', 'email', 'phone', 'obra_social')
                    ->get();

        return $pacientes;
        
    }
    
    public function datos_pacientes(Request $request)
    {
        // creo una validacion de datos
        // con $request->all() tomo todos los datos que ingreso
        $validarPaciente = Validator::make($request->all(), 
        
        [

            //'user_id' => 'required',

            'phone' => 'required|integer',

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

    
    

    
    public function update(Request $request, $id)
    {
        //
    }

   
    
}

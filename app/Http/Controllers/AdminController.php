<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    
    public function obtener_pacientes()
    {
        try {
            $pacientes = DB::table('users')
                ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                ->join('obra_sociales', 'obra_sociales.id', '=', 'pacientes.obra_social_id')
                ->select(
                    'pacientes.id as paciente_id',
                    'first_name AS nombre',
                    'last_name AS apellido',
                    'email',
                    'phone AS telefono',
                    'obra_sociales.id as obra_social_id',
                    'obra_sociales.obra_social'
                )
                ->get();

            return response()->json($pacientes);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al obtener pacientes'], 500);
        }
    }
    


    public function editar_usuario(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'user' => 'min:3'
            ]);

            $modificar_usu = ['user' => $request->user];

            $user = User::where('id', $id)->firstOrFail();
            $user->update($modificar_usu);

            return response()->json([
                'message' => '¡Usuario modificado!',
                'user' => $user
            ], 201);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al editar usuario'], 500);
        }
    }



    public function buscar_paciente_por_nombre($first_name)
    {
        try {
            $pacientes = DB::table('users')
                ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                ->join('obra_sociales', 'obra_sociales.id', '=', 'pacientes.obra_social_id')
                ->select('first_name AS nombre', 'last_name AS apellido', 'email', 'phone AS telefono', 'obra_social')
                ->where('first_name', 'LIKE', '%'.$first_name.'%')
                ->get();

            return response()->json($pacientes);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al buscar paciente por nombre'], 500);
        }
    }

   

    public function buscar_paciente_por_apellido($last_name)
    {
        try {
            $pacientes = DB::table('users')
                ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                ->join('obra_sociales', 'obra_sociales.id', '=', 'pacientes.obra_social_id')
                ->select('first_name AS nombre', 'last_name AS apellido', 'email', 'phone AS telefono', 'obra_social')
                ->where('last_name', 'LIKE', '%'.$last_name.'%')
                ->get();

            return response()->json($pacientes);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al buscar paciente por apellido'], 500);
        }
    }



    public function buscar_paciente($first_name, $last_name)
    {
        try {
            $pacientes = DB::table('users')
                ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                ->join('obra_sociales', 'obra_sociales.id', '=', 'pacientes.obra_social_id')
                ->select('first_name AS nombre', 'last_name AS apellido', 'email', 'phone AS telefono', 'obra_social')
                ->where('first_name', 'LIKE', '%'.$first_name.'%')
                ->where('last_name', 'LIKE', '%'.$last_name.'%')
                ->get();

            return response()->json($pacientes);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al buscar paciente por nombre y apellido'], 500);
        }
    }


    public function buscar_paciente_por_obra_social($obra_social)
    {
        try {
            $pacientes = DB::table('pacientes')
                ->join('obra_sociales', 'pacientes.obra_social_id', '=', 'obra_sociales.id')
                ->join('users', 'users.id', '=', 'pacientes.user_id')
                ->select('first_name AS nombre', 'last_name AS apellido')
                ->where('obra_social', 'LIKE', '%'.$obra_social.'%')
                ->get();

            return response()->json($pacientes);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al buscar por obra social'], 500);
        }
    }


  
    public function guard()
    {
        return Auth::guard();
    }

    
    public function admin_perfil()
    {
        try {
            return response()->json(Auth::guard('api')->user());
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al obtener perfil del admin'], 500);
        }
    }

    
}
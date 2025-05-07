<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   
    // public function index()
    // {
    //     return User::whereHas("roles", function($q){ $q->where("name", "paciente"); })->get();
    // }

    
    public function obtener_pacientes()
    {

        $pacientes = DB::table('users')
        ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
        ->join('obra_sociales', 'obra_sociales.id', '=', 'pacientes.obra_social_id')
        ->select('pacientes.id as paciente_id', 'first_name AS nombre', 'last_name AS apellido', 'email', 'phone AS telefono', 'obra_sociales.id as obra_social_id', 'obra_sociales.obra_social')
        ->get();

    return $pacientes;
        
    }
    


    public function editar_usuario(Request $request, $id)
    {
       
            $this->validate($request, [

                'user' => 'min:3'

            ]);

            $modificar_usu = [
                'user' => $request->user
            ];

            $user = User::where('id', $id)->firstOrFail();

            $user->update($modificar_usu);

            return response()->json([

                'message' => '¡Usuario modificado!',
                'user' => $user

            ], 201);
            
    }


    public function buscar_paciente_por_nombre($first_name)
    {

        $pacientes = DB::table('users')
                    ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                    ->join('obra_sociales', 'obra_sociales.id' , '=', 'pacientes.obra_social_id')
                    ->select('first_name AS nombre', 'last_name AS apellido', 'email', 'phone AS telefono', 'obra_social')
                    ->where('first_name', 'LIKE', '%'.$first_name.'%')
                    ->get();


        return response()->json($pacientes);
    }

   

    public function buscar_paciente_por_apellido($last_name)
    {
        $pacientes = DB::table('users')
                    ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                    ->join('obra_sociales', 'obra_sociales.id' , '=', 'pacientes.obra_social_id')
                    ->select('first_name AS nombre', 'last_name AS apellido', 'email', 'phone AS telefono', 'obra_social')
                    ->where('last_name', 'LIKE', '%'.$last_name.'%')
                    ->get(); 

        return response()->json($pacientes);
    }



    public function buscar_paciente($first_name, $last_name)
    {
        $pacientes = DB::table('users')
                    ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                    ->join('obra_sociales', 'obra_sociales.id' , '=', 'pacientes.obra_social_id')
                    ->select('first_name AS nombre', 'last_name AS apellido', 'email', 'phone AS telefono', 'obra_social')
                    ->where('first_name', 'LIKE', '%'.$first_name)
                    ->where('last_name', 'LIKE', '%'.$last_name)
                    ->get(); 

        return response()->json($pacientes);
    }


    public function buscar_paciente_por_obra_social($obra_social)
    {
        $pacientes = DB::table('pacientes')
                    ->join('obra_sociales', 'pacientes.obra_social_id' , '=' , 'obra_sociales.id')
                    ->join('users', 'users.id' , '=' , 'pacientes.user_id')
                    ->select('first_name AS nombre', 'last_name AS apellido')
                    ->where('obra_social', 'LIKE', '%'.$obra_social.'%')
                    ->get();

        return response()->json($pacientes);
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

    public function admin_perfil()
    {
        return response()->json(Auth::guard('api')->user());
    }

    
}
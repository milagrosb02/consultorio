<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
                    ->join('obra_sociales', 'obra_sociales.id' , '=', 'pacientes.obra_social_id')
                    ->select('first_name AS nombre', 'last_name AS apellido', 'email', 'phone AS telefono', 'obra_social')
                    ->get();

        return $pacientes;
        
    }
    


    public function update_user(Request $request, $id)
    {
       
        $this->validate($request, [

            'user' => 'min:3'

        ]);

            $modificar_usu = [

                'user' => $request->user
            ];

             User::whereId($id)->update($modificar_usu);


             return response()->json([

                 'message' => '¡Usuario modificado!',
                 'user' => $modificar_usu
    
             ], 201);

        
    }


    public function buscar_paciente_por_nombre($first_name)
    {
        $users = User::where('first_name', 'LIKE', '%'.$first_name.'%')
        ->where('first_name', 'LIKE', '%'.$first_name.'%')
        ->get(); 

        return response()->json($users);
    }


    public function buscar_paciente_por_apellido($last_name)
    {
        $users = User::where('last_name', 'LIKE', '%'.$last_name.'%')
        ->where('last_name', 'LIKE', '%'.$last_name.'%')
        ->get(); 

        return response()->json($users);
    }


    public function buscar_paciente($first_name, $last_name)
    {
        $users = User::where('first_name', 'LIKE', '%'.$first_name.'%')
                 ->where('last_name', 'LIKE', '%'.$last_name.'%')
                 ->get();

    return response()->json($users);
    }

    
}
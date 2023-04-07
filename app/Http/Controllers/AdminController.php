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

    
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
   
    public function index()
    {
        return User::whereHas("roles", function($q){ $q->where("name", "paciente"); })->get();
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
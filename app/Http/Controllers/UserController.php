<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

     /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }


    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    //public function me()
    // hacer un if o un controlador diferente
    //{
        //return response()->json($this->guard()->user()->load('paciente'));

        //ejemplo
        // if ($user == "administrador" || $user == "profesional") {
        //     return response()->json($this->guard()->user());
        // }else if ($user == "paciente"){
        //     return response()->json($this->guard()->user()->load('paciente'));
        // }
    //}


    
    public function editar_clave(Request $request, $user_id)
    {
        $this->validate($request, [

            'password' => 'min:5'

        ]);

            $modificar_pass = [

                'password' => bcrypt($request->password)
            ];

             User::whereId($user_id)->update($modificar_pass);


             return response()->json([

                 'message' => '¡Clave modificado!',
                 'password' => $modificar_pass
    
             ], 201);

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

     
    public function guard()
    {
        return Auth::guard();
    }



    
    public function editar_clave(Request $request, $user_id)
    {
        try {
            $this->validate($request, [
                'password' => 'min:5'
            ]);

            $modificar_pass = [
                'password' => bcrypt($request->password)
            ];

            User::whereId($user_id)->update($modificar_pass);

            return response()->json([
                'message' => '¡Clave modificada!',
                'password' => $modificar_pass
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Error al modificar la clave.'
            ], 500);
        }
    }
}

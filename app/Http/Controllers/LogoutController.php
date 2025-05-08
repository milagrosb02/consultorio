<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{

    
    public function guard()
    {
        return Auth::guard();
    }
    

    public function logout()
    {
         try {
         $this->guard()->logout();

            return response()->json(['message' => '¡Logout con éxito!']);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Error al cerrar sesión.',
                'detalle' => $th->getMessage()
            ], 500);
        }
    }

}

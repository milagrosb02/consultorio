<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;


class LoginPacienteController extends Controller
{

    
    public function __construct()
    {
        // como el registro no esta como metodo, lo agrego (esta en la ruta)
        $this->middleware('auth:api', ['except' => ['login']]);
    }



    // hay que resolver esta funcion (admin no puede ingresar con user, solo con mail)
     public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json(['error' => 'Credenciales incorrectas.'], 401);
            }

            if ($token = $this->guard()->attempt($credentials)) {
                $user_id = $user->id;

                $rol = match (true) {
                    $user_id === 1 => 'admin',
                    in_array($user_id, [2, 3]) => 'doctora',
                    default => 'paciente'
                };

                $data = [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $this->guard()->factory()->getTTL() * 60,
                    'user_id' => $user_id,
                    'rol' => $rol,
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                ];

                if ($rol === 'paciente') {
                    $data['paciente_id'] = $user->paciente->id ?? null;
                }

                return response()->json($data);
            }

            return response()->json(['error' => 'No se pudo generar el token.'], 401);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Ocurrió un error durante el inicio de sesión.',
                'detalle' => $th->getMessage()
            ], 500);
        }
    }

    

    public function guard()
    {
        return Auth::guard();
    }

}

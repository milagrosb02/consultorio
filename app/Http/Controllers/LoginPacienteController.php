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
            $credentials = $request->only('email', 'password');

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Las credenciales son incorrectas.']
                ]);
            }

            $credentials['email'] = $user->email;
            $credentials['first_name'] = $user->first_name;
            $credentials['last_name'] = $user->last_name;

            if ($user->hasRole('paciente')) {
                $data['rol'] = 'paciente';
            }

            if ($token = $this->guard()->attempt($credentials)) {
                $paciente = $user->paciente; // Obtener el paciente asociado al usuario
                $data = [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $this->guard()->factory()->getTTL() * 60,
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'paciente_id' => $paciente ? $paciente->id : null,
                    'rol' => $data['rol'] ?? null
                ];
                return response()->json($data);
            }

            return response()->json(['error' => 'No se pudo iniciar la sesión.'], 401);

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

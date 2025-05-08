<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginAdminController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // como el registro no esta como metodo, lo agrego (esta en la ruta)
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    
    public function login(Request $request)
    {
        try {
            $request->validate([
                'user' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('user', 'password');

            $user = User::where('user', $credentials['user'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'user' => ['Las credenciales son incorrectas.'],
                ]);
            }

            if ($token = $this->guard()->attempt($credentials)) {
                $user_id = Auth::user()->id;
                return $this->respondWithToken($token, $user_id);
            }

            return response()->json(['error' => 'No se pudo generar el token.'], 401);

        } catch (ValidationException $e) {
            throw $e; // Esto permite que Laravel maneje los mensajes de validación como siempre

        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Ocurrió un error.',
                'detalle' => $th->getMessage(), // útil para debug
            ], 500);
        }
    }



    protected function respondWithToken($token, $user_id)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user_id' => $user_id // Agrega el ID del usuario al resultado
        ]);
    }


     
    public function guard()
    {
        return Auth::guard();
    }

}
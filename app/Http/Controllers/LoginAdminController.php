<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('user', 'password');

        $verifyPass = $request->only('password');

        $verifyUser = $request->only('user');



        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }
        

        // Validacion de clave incorrecta
        if(! $token = auth() ->attempt($verifyPass)){
            return response()->json(['error' => 'La contraseña es incorrecta. '], 401);
        }


        // Validacion de usuario incorrecto
        if(! $token = auth() ->attempt($verifyUser)){
            return response()->json(['error' => 'El usuario es incorrecto. '], 401);
        }


        return response()->json(['error' => 'Unauthorized'], 401);
    }




    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
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

}
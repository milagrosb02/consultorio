<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // como el registro no esta como metodo, lo agrego (esta en la ruta)
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
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
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
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



    public function register(Request $request)
    {
        // creo una validacion de datos
        // con $request->all() tomo todos los datos que ingreso
        $validator = Validator::make($request->all(), [

            'first_name' => 'required|string|max:25',

            'last_name' => 'required|string|max:25',

            'user' => 'string|min:6',

            'email' => 'required|string|email|unique:users|min:10',

            'password' => 'required|string|min:5|confirmed',

            'password_confirmation' => 'required|same:password|min:5'

        ]);


        // si la solicitud no es valida
        if($validator->fails()){

            return response()->json($validator->errors()->toJson(), 400);

        }

        // si la solicitud es valida, creo el nuevo usuario
        $user = User::create(array_merge(
            $validator->validate(),
            // encripto la contraseña
            ['password' => bcrypt($request->password)]
        ))->assignRole('paciente');


        return response()->json([

            'message' => '¡Usuario creado!',
            'user' => $user

        ], 201);
    }
}
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
    $credentials = $request->only('email', 'password');

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Las credenciales son incorrectas.'],
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
            'paciente_id' => $paciente ? $paciente->id : null, // Agregar el paciente_id
            'rol' => isset($data['rol']) ? $data['rol'] : null // Agregar la clave 'rol'
        ];
        return response()->json($data);
    }

    return response()->json(['error' => 'No se pudo iniciar la sesión.'], 401);
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

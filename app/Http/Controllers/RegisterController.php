<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PacienteController;
use App\Http\Requests\PacienteRequest;
use App\Models\ObraSociale;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;



class RegisterController extends Controller
{


    public function __construct()
    {
        // como el registro no esta como metodo, lo agrego (esta en la ruta)
        $this->middleware('auth:api', ['except' => ['register']]);
    }


    public function guard()
    {
        return Auth::guard();
    }

    public function pacientes(Request $request)
    {
        app(PacienteController::class)->datos_pacientes();
    }

    public function obra_social(Request $request)
    {
        app(ObraSocialController::class)->index();
    }




    public function register(Request $request)
    {
        try {
            $rules = [
                'first_name' => ['required', 'max:25'],
                'last_name' => ['required', 'max:25'],
                'email' => ['required', 'unique:users', 'email', 'min:10'],
                'password' => ['required', 'min:5', 'confirmed'],
                'password_confirmation' => ['required', 'same:password', 'min:5'],
                'phone' => ['required', 'max:20'],
                'obra_social_id' => ['required']
            ];

            $messages = [
                'first_name.required' => 'El nombre es obligatorio.',
                'first_name.max' => 'Nombre demasiado largo.',
                'last_name.required' => 'El apellido es obligatorio.',
                'last_name.max' => 'Apellido demasiado largo.',
                'email.required' => 'El email es obligatorio.',
                'email.unique' => 'Este email ya está en uso. Ingresa otro.',
                'email.email' => 'El email debe ser válido. Ingresa otro.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.min' => 'La contraseña es muy corta.',
                'password_confirmation.same' => 'Las contraseñas no coinciden.',
                'phone.required' => 'El teléfono es obligatorio.',
                'phone.max' => 'El teléfono no es válido.',
                'obra_social_id.required' => 'La obra social es obligatoria.'
            ];

            $validateUser = Validator::make($request->all(), $rules, $messages);

            if ($validateUser->fails()) {
                return response()->json($validateUser->errors()->toJson(), 422);
            }

            $user = User::create(array_merge(
                $validateUser->validate(),
                ['password' => bcrypt($request->password)]
            ))->assignRole('paciente');

            $pacienteRoleId = Role::where('name', 'paciente')->value('id');

            Paciente::create([
                'user_id' => $user->id,
                'phone' => $request->input('phone'),
                'obra_social_id' => $request->input('obra_social_id')
            ]);

            $user->load('paciente');

            event(new Registered($user));

            return response()->json([
                'message' => '¡Paciente creado!',
                'user' => $user,
                'rol_id' => $pacienteRoleId
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Ocurrió un error al registrar el paciente.',
                'detalle' => $th->getMessage()
            ], 500);
        }
    }



   

}

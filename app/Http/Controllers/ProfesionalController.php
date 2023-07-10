<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfesionalController extends Controller
{
   
    public function ver_pacientes($profesional_id)
    {
        // $pacientes = DB::table('users')
        //             ->join('pacientes', 'users.id', '=' , 'pacientes.user_id')
        //             ->join('turnos', 'pacientes.id', '=' , 'turnos.paciente_id')
        //             ->select('first_name AS nombre', 'last_name AS apellido')
        //             ->where('turnos.user_id', '=' , $profesional_id)
        //             ->distinct()
        //             ->get();

        // return response()->json($pacientes);

        $pacientes = DB::table('users')
        ->join('pacientes', 'users.id', '=' , 'pacientes.user_id')
        ->join('turnos', 'pacientes.id', '=' , 'turnos.paciente_id')
        ->select('first_name AS nombre', 'last_name AS apellido')
        ->whereDate('fecha', now())
        ->where('turnos.user_id', '=' , $profesional_id)
        ->get();

        return response()->json($pacientes);
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

    public function profesional_perfil()
    {
        return response()->json($this->guard()->user());
    }

}

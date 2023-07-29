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
        $turnosPacientes = DB::table('users')
        ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
        ->join('turnos', 'pacientes.id', '=', 'turnos.paciente_id')
        ->select('pacientes.id AS paciente_id', // Usamos pacientes.id para obtener el ID del paciente
            'first_name AS nombre',
            'last_name AS apellido',
            DB::raw('COALESCE(turnos.motivo_consulta, especialidades.especialidad) AS motivo_consulta'),
            'fecha', 'hora')
        ->leftJoin('especialidades', 'turnos.especialidad_id', '=', 'especialidades.id')
        ->whereDate('fecha', now())
        ->where('turnos.user_id', '=', $profesional_id)
        ->get();

    return response()->json($turnosPacientes);
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

    // public function profesional_perfil()
    // {
    //     return response()->json($this->guard()->user());
    // }


    public function profesional_perfil($usuario_id)
    {
        $usuario = User::select('first_name as nombre', 'last_name as apellido', 'user as usuario')
            ->find($usuario_id);

        return response()->json($usuario);
    }
}

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
        try {
            if (!in_array($profesional_id, [2, 3])) {
                return response()->json(['error' => 'Profesional no autorizado.'], 403);
            }

            $turnosPacientes = DB::table('users')
                ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                ->join('turnos', 'pacientes.id', '=', 'turnos.paciente_id')
                ->leftJoin('especialidades', 'turnos.especialidad_id', '=', 'especialidades.id')
                ->select(
                    'pacientes.id AS paciente_id',
                    'first_name AS nombre',
                    'last_name AS apellido',
                    DB::raw('COALESCE(turnos.motivo_consulta, especialidades.especialidad) AS motivo_consulta'),
                    'fecha',
                    'hora'
                )
                ->whereDate('fecha', now())
                ->where('turnos.user_id', '=', $profesional_id)
                ->get();

            if ($turnosPacientes->isEmpty()) {
                return response()->json(['message' => 'No hay pacientes asignados para hoy.'], 200);
            }

            return response()->json($turnosPacientes);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al obtener los pacientes del profesional.'], 500);
        }
    }






    public function guard()
    {
        return Auth::guard();
    }

  
    public function profesional_perfil($usuario_id)
    {
        try {
            $usuario = User::select('first_name as nombre', 'last_name as apellido', 'user as usuario')
                ->find($usuario_id);

            if (!$usuario) {
                return response()->json(['message' => 'Profesional no encontrado.'], 404);
            }

            return response()->json($usuario);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al obtener el perfil del profesional.'], 500);
        }
    }
}

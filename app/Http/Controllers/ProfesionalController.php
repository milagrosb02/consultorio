<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfesionalController extends Controller
{
   
    public function ver_pacientesGalmarini()
    {
        $pacientes = DB::table('users')
                    ->join('pacientes', 'users.id', '=' , 'pacientes.user_id')
                    ->join('turnos', 'pacientes.id', '=' , 'turnos.paciente_id')
                    ->select('first_name AS nombre', 'last_name AS apellido')
                    ->where('turnos.user_id', '=' , '3')
                    ->get();

        return response()->json($pacientes);
    }



    
    public function ver_pacientesPadros()
    {
        $pacientes = DB::table('users')
                    ->join('pacientes', 'users.id', '=' , 'pacientes.user_id')
                    ->join('turnos', 'pacientes.id', '=' , 'turnos.paciente_id')
                    ->select('first_name AS nombre', 'last_name AS apellido')
                    ->where('turnos.user_id', '=' , '2')
                    ->get();

        return response()->json($pacientes);
    }

    

    public function ver_turnosPadros()
    {
        
    }


    public function ver_turnosGalmarini()
    {

    }

}

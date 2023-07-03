<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TurnoResource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Rules\UniqueAppointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;

class TurnoController extends Controller
{
   
    public function index()
    {
        //return TurnoResource::collection(Turno::all());

        return TurnoResource::collection(Turno::with('user', 'especialidad')->get());
    }

    
    public function store(Request $request)
    {
        //reglas de validacion

        $rules = 
        [
            'user_id' => ['required'],

            'especialidad_id' => ['nullable'],

            'motivo_consulta' => ['nullable', 'string', 'max:100'],

            'fecha' => ['required', 'after:today'],

            'hora' => ['required', new UniqueAppointment($request->input('fecha'), $request->input('hora'), $request->input('user_id'))],

            'paciente_id' => ['required']

        ];


        // creo los mensajes
        $messages = 
        [
            'user_id.required' => 'Debe escoger una odontóloga. ',

            'motivo_consulta.string' => 'El campo debe ser rellenado con caracteres alfanuméricos. ',

            'motivo_consulta.max' => 'El campo excedio la cantidad de caracteres. ',

            'fecha.required' => 'Debe escoger una fecha disponible. ',

            'fecha.after' => 'No puede seleccionar una fecha pasada. ',

            'hora.required' => 'Debe escoger un horario disponible. '

        ];



        // creo la validación de datos
        $validateConsulta = Validator::make($request->all(), $rules, $messages);



        $fecha = Carbon::createFromFormat('Y-m-d', $request->input('fecha'));
        $hora = Carbon::createFromFormat('H:i', $request->input('hora'));


        // busco el id del paciente
        $paciente = Paciente::findOrFail($request->paciente_id);

        // verifico si ya tiene un turno anterior
        if (!$paciente->registrarTurno()) 
        {
            return response()->json([
                'message' => 'Ya tenes un turno pendiente.',
            ], 400);
        }


        $turno = Turno::create(array_merge($validateConsulta->validate(), [
            'fecha' => $fecha->format('Y-m-d'),
            'hora' => $hora->format('H:i'),
        ]));


        return response()->json([

            'message' => '¡Turno creado!',
            'turno' => $turno

        ], 201);

    }

   

    public function show($paciente_id)
    {

        $turno = Turno::where('paciente_id', $paciente_id)->get();

    

        if ($turno->isEmpty()) 
        {
            return response()->json
            ([

                'message' => 'Aún no posees un turno.'

            ], 404);

        } 
        else 
        {
            return response()->json
            ([

                'message' => '¡Aquí está tu turno!',

                'turno' => $turno

            ], 201);
        }


        
    }


   
    public function cancelar_turno($turno_id)
    {

        $turno = Turno::find($turno_id);

        if ($turno) 
        {

            $turno->delete();
    
            return response()->json([

                'message' => '¡El turno se ha cancelado correctamente!',

                'turno' => $turno

            ], 201);

        } else 
        
        {
            return response()->json([

                'message' => 'No se encontró el turno a cancelar.'

            ], 404);
        }
        

    }


    public function filtrar_turno_por_mes($mes)
    {
        $pacientes = DB::table('users')
                    ->join('pacientes', 'users.id', '=' , 'pacientes.user_id')
                    ->join('turnos', 'pacientes.id', '=' , 'turnos.paciente_id')
                    ->select('first_name AS nombre', 'last_name AS apellido')
                    ->whereMonth('fecha', $mes)
                    ->get();

        return response()->json($pacientes);
    }


    // esta funcion me puede llegar de servir para el legajo
    public function filtrar_turno_por_dia($fecha)
    {
        $pacientes = DB::table('users')
        ->join('pacientes', 'users.id', '=' , 'pacientes.user_id')
        ->join('turnos', 'pacientes.id', '=' , 'turnos.paciente_id')
        ->select('first_name AS nombre', 'last_name AS apellido')
        ->whereDate('fecha', $fecha)
        ->get();

        return response()->json($pacientes);
    }


    public function ver_turno_del_dia()
    {
        
    }



    public function ver_turno_admin($profesional_id)
    {
        $turnos = DB::table('users')
                    ->join('pacientes', 'users.id', '=' , 'pacientes.user_id')
                    ->join('turnos', 'pacientes.id', '=' , 'turnos.paciente_id')
                    ->select('first_name AS nombre', 'last_name AS apellido')
                    ->where('turnos.user_id', 'LIKE', '%'.$profesional_id.'%')
                    ->get();

        return response()->json($turnos);
    }


    
    // el parametro fecha viene del datepicker, se reemplaza por el now()
    public function fechashorasDisponibles($fecha)
    {
        $horarios = [];

        $fechas = Carbon::parse(now()->format('Y-m-d') . ' 8 am')
                    ->toPeriod(now()->format('Y-m-d') . ' 12 pm', 30, 'minutes');

        
        $turnos = Turno::whereDate('fecha', now())->get();

        
        foreach ($fechas as $fecha) {
            
            $horarios[$fecha->format('h:i A')] = !$turnos->contains('fecha', $fecha);

        }

        dd($horarios);            
    }




    public function generarTurnoPDF()
    {

        $turnos = Turno::with('user', 'paciente', 'especialidad')->get();


        //dd($legajos);
        $pdf = Pdf::loadView('turno', compact('turnos'))->setPaper('a4', 'landscape');

        

        return $pdf->stream('turnos_admin.pdf');

    }



    public function generarPDFPaciente($paciente_id)
    {

        $turnos = Turno::with('user', 'paciente', 'especialidad')->where("paciente_id",$paciente_id)->get();


        //dd($legajos);
        $pdf = Pdf::loadView('turno_paciente', compact('turnos'))->setPaper('a4', 'landscape');

        

        return $pdf->stream('turno_paciente_consultorio.pdf');
    }


}

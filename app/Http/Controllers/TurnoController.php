<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TurnoResource;
use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return TurnoResource::collection(Turno::all());

        return TurnoResource::collection(Turno::with('user', 'especialidad')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //reglas

        $rules = 
        [
            'user_id' => ['required'],

            'especialidad_id' => ['nullable'],

            'motivo_consulta' => ['string', 'max: 100', 'nullable'],

            'fecha' => ['required'],

            'hora' => ['required'],

            'paciente_id' => ['required']

        ];


        // creo los mensajes
        $messages = 
        [
            'user_id.required' => 'Debe escoger una odontóloga. ',

            'motivo_consulta.string' => 'El campo debe ser rellenado con caracteres alfanuméricos. ',

            'motivo_consulta.max' => 'El campo excedio la cantidad de caracteres. ',

            'fecha' => 'Debe escoger una fecha disponible. ',

            'hora' => 'Debe escoger un horario disponible. '

        ];


        // creo la validación de datos
        $validateConsulta = Validator::make($request->all(), $rules, $messages);


        $turno = Turno::create(array_merge($validateConsulta->validate()));


        return response()->json([

            'message' => '¡Turno creado!',
            'turno' => $turno

        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modificar_turno = 
        [

            'user_id' => $request->user_id, // profesional id

            'especialidad_id' => $request->especialidad_id,

            'motivo_consulta' => $request->motivo_consulta,

            'fecha' => $request->fecha,

            'hora' => $request->hora

        ];

        $turno = Turno::where('id', $id)->firstOrFail();


        $turno->update($modificar_turno);

            return response()->json([

                'message' => '¡Turno modificado!',
                'turno' => $turno

            ], 201);
            
    }

   
    public function cancelar_turno($id)
    {
        $turno = Turno::find($id);

        $turno->delete();

        return response()->json([

            'message' => '¡El turno se ha cancelado correctamente!',
            'turno' => $turno

        ], 201);
        

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


}

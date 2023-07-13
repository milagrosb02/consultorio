<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Legajo;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LegajoResource;
use App\Models\Tratamiento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LegajoController extends Controller
{
    
    public function index()
    {
        return LegajoResource::collection(Legajo::with('paciente', 'tratamiento', 'profesional')->get());
    }
    

    

    public function store(Request $request)
    {
        // reglas
        $rules = 
        [
            'paciente_id' => ['required'],

            'descripcion' => ['string', 'max: 100'],

            'tratamiento_id' => ['nullable'],

            'user_id' => ['required']


        ];


        // creo los mensajes de validacion
        $messages = 
        [
            'descripcion.string' => 'El campo debe ser rellenado con caracteres alfanuméricos. ',

            'descripcion.max' => 'El campo excedio la cantidad de caracteres. ',

            'user_id.required' => ['Debe estar el nombre de la profesional a cargo. ']

        ];


         // creo la validación de datos
         $validateLegajo = Validator::make($request->all(), $rules, $messages);

           // Verificar si la validación falla
        if ($validateLegajo->fails()) 
        {
            return response()->json
            ([
                'message' => 'Error en los datos enviados.',
                'errors' => $validateLegajo->errors(),
            ], 400);
        }



         $legajo = Legajo::create(array_merge($validateLegajo->validate(), [

            'fecha' => Carbon::now()->format('Y-m-d') 

         ]));


         return response()->json([
 
             'message' => '¡Historial clínico creado!',
             'legajo' => $legajo
 
         ], 201);


    }

    

    public function show($paciente_id)
    {

        $legajo = Legajo::where('paciente_id', $paciente_id)->get();


        if ($legajo->isEmpty()) 
        {
            return response()->json
            ([

                'message' => 'Aún no posees un historial clinico.'

            ], 404);

        } 
        else 
        {
            return response()->json
            ([

                'message' => '¡Aquí está tu historial clinico!',

                'legajo' => $legajo

            ], 201);
        }



    }

    

    public function update(Request $request, $id)
    {
        $modificar_legajo = 
        [

            'descripcion' => $request->descripcion,

            'tratamiento_id' => $request->tratamiento_id,

            'fecha' => $request->fecha

        ];


        $legajo = Legajo::where('id', $id)->firstOrFail();

        $legajo->update($modificar_legajo);

        return response()->json([

            'message' => '¡Historial Clinico modificado!',
            'legajo' => $legajo

        ], 201);
        
    }

    
    public function generarPDF()
    {

        $legajos = Legajo::with('paciente', 'profesional', 'tratamiento')->get();


        //dd($legajos);
        $pdf = Pdf::loadView('prueba1', compact('legajos'))->setPaper('a4', 'landscape');

        

        return $pdf->stream('paciente_legajo.pdf');

    }



    public function generarPDFPaciente($paciente_id)
    {
        $legajos = Legajo::with('paciente', 'profesional', 'tratamiento')->where("paciente_id",$paciente_id)->get();

        $legajo = Legajo::with('paciente')->where("paciente_id",$paciente_id)->latest()->first();

        $pdf = Pdf::loadView('legajo_paciente', compact('legajos', 'legajo'))->setPaper('a4', 'landscape');

        return $pdf->stream('paciente_legajo_unico.pdf');
    }


    // SELECT PARA CARGAR EL PACIENTE
    public function obtener_pacientes_por_nombres()
    {

        $pacientes = DB::table('users')
                    ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                    ->select('first_name AS nombre', 'last_name AS apellido')
                    ->get();

        return $pacientes;
        
    }


    // SELECT PARA TRAER LOS TRATAMIENTOS
    public function listar_tratamientos()
    {
        return Tratamiento::select('id', 'nombre')->get();
    }

    
}

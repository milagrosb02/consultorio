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
use App\Models\User;

class LegajoController extends Controller
{
    
    public function index()
    {
        return LegajoResource::collection(Legajo::with('paciente', 'tratamiento', 'profesional')->get());
        
    }
    

    

    public function store(Request $request)
    {
        try {
            $rules = [
                'paciente_id' => ['required'],
                'descripcion' => ['string', 'max:100'],
                'tratamiento_id' => ['required'],
                'user_id' => ['required']
            ];

            $messages = [
                'descripcion.string' => 'El campo debe ser rellenado con caracteres alfanuméricos.',
                'descripcion.max' => 'El campo excedió la cantidad de caracteres.',
                'user_id.required' => ['Debe estar el nombre de la profesional a cargo.']
            ];

            $validateLegajo = Validator::make($request->all(), $rules, $messages);

            if ($validateLegajo->fails()) {
                return response()->json([
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

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al crear legajo'], 500);
        }
    }


    

    public function show($paciente_id)
    {
        try {
            $legajo = Legajo::where('paciente_id', $paciente_id)->get();

            if ($legajo->isEmpty()) {
                return response()->json(['message' => 'Aún no posees un historial clínico.'], 404);
            } else {
                return response()->json([
                    'message' => '¡Aquí está tu historial clínico!',
                    'legajo' => $legajo
                ], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al obtener legajo'], 500);
        }
    }

    
    

    public function update(Request $request, $legajo_id)
    {
        try {
            $modificar_legajo = $request->only(['descripcion', 'tratamiento_id']);

            $legajo = Legajo::where('id', $legajo_id)->latest('fecha')->firstOrFail();
            $legajo->update($modificar_legajo);

            return response()->json([
                'message' => '¡Historial Clínico modificado!',
                'legajo' => $legajo
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al modificar legajo'], 500);
        }
    }



    public function showLegajoAdmin($paciente_id)
    {
        try {
            $legajo = Legajo::where('paciente_id', $paciente_id)->latest('fecha')->first();

            if (!$legajo) {
                return ['message' => 'Aún no posees un historial clínico.'];
            } else {
                return [
                    'message' => '¡Aquí está tu historial clínico!',
                    'legajo' => $legajo
                ];
            }
        } catch (\Throwable $th) {
            return ['error' => 'Error al obtener historial clínico'];
        }
    }



    
    public function generarPDF()
    {
        try {
            $legajos = Legajo::with('paciente', 'profesional', 'tratamiento')->get();
            $pdf = Pdf::loadView('prueba1', compact('legajos'))->setPaper('a4', 'landscape');
            return $pdf->stream('paciente_legajo.pdf');
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al generar PDF'], 500);
        }
    }




    public function generarPDFPaciente($paciente_id)
    {
        try {
            $legajos = Legajo::with('paciente', 'profesional', 'tratamiento')->where("paciente_id", $paciente_id)->get();
            $legajo = Legajo::with('paciente')->where("paciente_id", $paciente_id)->latest()->first();
            $pdf = Pdf::loadView('legajo_paciente', compact('legajos', 'legajo'))->setPaper('a4', 'landscape');
            return $pdf->stream('paciente_legajo_unico.pdf');
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al generar PDF del paciente'], 500);
        }
    }


    // SELECT PARA CARGAR EL PACIENTE
    public function obtener_pacientes_por_nombres()
    {
        try {
            $pacientes = DB::table('users')
                ->join('pacientes', 'users.id', '=', 'pacientes.user_id')
                ->select('first_name AS nombre', 'last_name AS apellido')
                ->get();

            return $pacientes;
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al obtener pacientes'], 500);
        }
    }


    // SELECT PARA TRAER LOS TRATAMIENTOS
    public function listar_tratamientos()
    {
        try {
            return Tratamiento::select('id', 'nombre')->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al listar tratamientos'], 500);
        }
    }



    public function listar_dentistas()
    {
        try {
            $dentistas = User::select('id', 'first_name', 'last_name')->whereIn('id', [2, 3])->get();
            return response()->json($dentistas);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al listar dentistas'], 500);
        }
    }
    
}

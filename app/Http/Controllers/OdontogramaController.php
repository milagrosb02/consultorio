<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Odontograma;
use Carbon\Carbon;
use App\Http\Resources\OdontogramaResource;
use App\Models\AnomaliaColor;
use App\Models\CaraOdontograma;
use App\Models\Legajo;
use App\Models\Paciente;
use App\Models\Pieza;

class OdontogramaController extends Controller
{
    
    public function index()
    {
        return OdontogramaResource::collection(Odontograma::with('piezas', 'tratamiento', 'anomalia_color', 'legajo', 'cara_odontograma')->get());
    }

    

    public function store(Request $request)
    {
        try {
            $rules = [
                'paciente_id' => ['required'],
                'pieza_id' => ['required', 'array'],
                'tratamiento_id' => ['required'],
                'anomalia_color_id' => ['required'],
                'cara_odontograma_id' => ['required'],
                'diagnostico' => ['string', 'required'],
            ];

            $messages = [
                'paciente_id.required' => ['Debe seleccionar el paciente. '],
                'pieza_id.required' => ['Debe seleccionar una pieza dental. '],
                'diagnostico.required' => ['Debes escribir un diagnóstico. '],
                'tratamiento_id.required' => ['Debe seleccionar un tratamiento.'],
                'anomalia_color_id.required' => ['Selecciona un color de referencia. '],
                'cara_odontograma_id.required' => ['Debe seleccionar la cara. '],
            ];

            $validateOdontograma = Validator::make($request->all(), $rules, $messages);

            if ($validateOdontograma->fails()) {
                return response()->json([
                    'message' => 'Error en los datos enviados.',
                    'errors' => $validateOdontograma->errors(),
                ], 400);
            }

            $piezasSeleccionadas = $request->input('pieza_id');

            $odontograma = Odontograma::create([
                'paciente_id' => $request->input('paciente_id'),
                'pieza_id' => $piezasSeleccionadas[0],
                'tratamiento_id' => $request->input('tratamiento_id'),
                'anomalia_color_id' => $request->input('anomalia_color_id'),
                'cara_odontograma_id' => $request->input('cara_odontograma_id'),
                'diagnostico' => $request->input('diagnostico'),
            ]);

            $odontograma->piezas()->sync($piezasSeleccionadas);

            return response()->json([
                'message' => '¡Odontograma creado!',
                'odontograma' => $odontograma,
            ], 201);

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Ocurrió un error al crear el odontograma.'], 500);
        }
    }


     public function show($paciente_id)
    {
        try {
            $odontograma = Odontograma::where('paciente_id', $paciente_id)->get();

            if ($odontograma->isEmpty()) {
                return response()->json(['message' => 'Aún no posees un odontograma.'], 404);
            }

            return response()->json([
                'message' => '¡Aquí está tu odontograma!',
                'odontograma' => $odontograma
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al obtener el odontograma.'], 500);
        }
    }



    public function showOdontoAdmin($paciente_id)
    {
        try {
            $odontogramas = Odontograma::with('piezas', 'tratamiento', 'anomalia_color', 'paciente', 'cara_odontograma')
                ->where('paciente_id', $paciente_id)
                ->latest()
                ->first();

            $piezas = Pieza::join('odontograma_piezas', 'piezas.id', '=', 'odontograma_piezas.pieza_id')
                ->join('odontogramas', 'odontograma_piezas.odontograma_id', '=', 'odontogramas.id')
                ->select('odontograma_piezas.pieza_id')
                ->where('paciente_id', $paciente_id)
                ->get();

            if (empty($odontogramas)) {
                return response()->json(['message' => 'Aún no posees un odontograma.'], 404);
            }

            return response()->json([
                'message' => '¡Aquí está tu odontograma!',
                'odontogramas' => $odontogramas,
                'piezas' => $piezas
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al obtener los datos del odontograma.'], 500);
        }
    }



    public function update(Request $request, $odontograma_id)
    {
        try {
            $modificar_odontograma = $request->only([
                'tratamiento_id',
                'diagnostico',
                'anomalia_color_id',
                'cara_odontograma_id'
            ]);

            $odontograma = Odontograma::where('id', $odontograma_id)->latest()->first();

            $odontograma->update($modificar_odontograma);
            $odontograma->fecha_actualizacion = now();
            $odontograma->save();

            $piezasSeleccionadas = $request->input('pieza_id');
            $odontograma->piezas()->sync($piezasSeleccionadas);

            $ultimo_odontograma = Odontograma::where('paciente_id', $odontograma->paciente_id)
                ->latest('fecha_actualizacion')
                ->first();

            return response()->json([
                'message' => '¡Odontograma modificado!',
                'odontograma' => $ultimo_odontograma
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al actualizar el odontograma.'], 500);
        }
    }



    public function generarOdontogramaPDF($paciente_id)
    {
        try {
            $odontogramas = Odontograma::with('piezas', 'tratamiento', 'anomalia_color', 'paciente', 'cara_odontograma')
                ->where("paciente_id", $paciente_id)->get();

            $referencias_colores = AnomaliaColor::select('color', 'descripcion')->get();

            $odontograma = Odontograma::with('paciente')->where("paciente_id", $paciente_id)->latest()->first();

            $pdf = Pdf::loadView('odonto_paciente', compact('odontogramas', 'odontograma', 'referencias_colores'))
                ->setPaper('a4', 'landscape');

            return $pdf->stream('paciente_odontograma_unico.pdf');
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al generar el PDF del odontograma.'], 500);
        }
    }

  
    public function listar_piezas_dentales()
    {
        return Pieza::select('id', 'pieza')->get();
    }


    public function listar_caras_dentales()
    {
        return CaraOdontograma::select('id', 'nombre')->get();
    }


    public function listar_colores_anomalias()
    {
        return AnomaliaColor::select('id', 'color')->get();
    }

}

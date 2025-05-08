<?php

namespace App\Http\Controllers;

use App\Models\ObraSociale;
use Illuminate\Http\Request;
use App\Http\Resources\ObraSocialResource;
use App\Models\Paciente;
use App\Models\User;
use App\Notifications\RecordatorioDeTurnoNotification;
use Illuminate\Support\Facades\Validator;
use App\Rules\Uppercase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Models\Turno;
use Carbon\Carbon;

class ObraSocialController extends Controller
{
    
    public function index()
    {
        return ObraSocialResource::collection(ObraSociale::all());
    }



   
    public function store(Request $request)
{
    $rules = [
        'obra_social' => ['required', 'string', 'min:3', 'unique:obra_sociales', new Uppercase]
    ];

    $messages = [
        'obra_social.required' => 'La obra social es obligatoria.',
        'obra_social.string' => 'La obra social no es válida. Ingresa nuevamente.',
        'obra_social.min' => 'La obra social no es válida. Ingresa nuevamente.',
        'obra_social.unique' => 'Esta obra social ya está registrada. Ingresa otra.',
        'obra_social.uppercase' => 'El registro debe estar todo en MAYÚSCULAS.'
    ];

    $validator = Validator::make($request->only('obra_social'), $rules, $messages);

    // Si falla la validación, se devuelve el error y no entra al try
    if ($validator->fails()) {
        return response()->json([
            'message' => 'Error en los datos enviados.',
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $obraSocial = ObraSociale::create($validator->validated());

        return response()->json([
            'message' => '¡Obra Social creada!',
            'obra_social' => $obraSocial
        ], 201);
    } catch (\Throwable $th) {
        return response()->json([
            'error' => 'Error al crear la obra social.',
            'detalle' => $th->getMessage()
        ], 500);
    }
}

    

    
    public function destroy(Request $request, $id)
    {
        try {
            ObraSociale::whereId($id)->delete();

            return response()->json([
                'message' => '¡Cobertura médica borrada!'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Error al eliminar la cobertura médica.',
                'detalle' => $th->getMessage()
            ], 500);
        }
    }



    public function buscar_obra_social($obra_social)
    {
        try {
            $obras_sociales = DB::table('obra_sociales')
                ->select('obra_social AS obra social')
                ->where('obra_social', 'LIKE', '%' . $obra_social . '%')
                ->get();

            return response()->json($obras_sociales);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Error al buscar la obra social.',
                'detalle' => $th->getMessage()
            ], 500);
        }
    }

}
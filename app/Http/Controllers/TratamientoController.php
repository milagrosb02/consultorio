<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TratamientoResource;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TratamientoController extends Controller
{
   
    public function index()
    {
        return TratamientoResource::collection(Tratamiento::all());
    }

    
    public function store(Request $request)
    {
        try {
            $rules = [
                'nombre' => ['required', 'string', 'max:70', 'unique:tratamientos,nombre']
            ];

            $messages = [
                'nombre.required' => 'El tratamiento es requerido.',
                'nombre.string' => 'El nombre del tratamiento debe ser alfanumérico.',
                'nombre.max' => 'El nombre del tratamiento es demasiado largo.',
                'nombre.unique' => 'Este tratamiento ya se encuentra en la lista.'
            ];

            $validateTratamiento = Validator::make($request->only('nombre'), $rules, $messages);

            if ($validateTratamiento->fails()) {
                return response()->json([
                    'message' => 'Error en los datos enviados.',
                    'errors' => $validateTratamiento->errors(),
                ], 400);
            }

            $tratamiento = Tratamiento::create($validateTratamiento->validate());

            return response()->json([
                'message' => '¡Tratamiento creado!',
                'tratamiento' => $tratamiento
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al crear el tratamiento.'], 500);
        }
    }

   

    public function destroy(Request $request, $id)
    {
        try {
            Tratamiento::whereId($id)->delete();

            return response()->json([
                'message' => '¡Tratamiento borrado!'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al borrar el tratamiento.'], 500);
        }
    }


    



    public function buscar_tratamiento($tratamiento)
    {
        try {
            $tratamientos = DB::table('tratamientos')
                ->select('nombre AS tratamiento')
                ->where('nombre', 'LIKE', '%'.$tratamiento.'%')
                ->get();

            return response()->json($tratamientos);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al buscar tratamientos.'], 500);
        }
    }

   
}

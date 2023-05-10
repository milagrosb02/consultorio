<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Legajo;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LegajoResource;

class LegajoController extends Controller
{
    
    public function index()
    {
        return LegajoResource::collection(Legajo::with('paciente', 'tratamientos')->get());
    }
    

    

    public function store(Request $request)
    {
        // reglas
        $rules = 
        [
            'paciente_id' => ['required'],

            'descripcion' => ['string', 'max: 100'],

            'tratamiento_id' => ['nullable'],

            'fecha' => ['required']

        ];


        // creo los mensajes de validacion
        $messages = 
        [
            'descripcion.string' => 'El campo debe ser rellenado con caracteres alfanuméricos. ',

            'descripcion.max' => 'El campo excedio la cantidad de caracteres. ',

            'fecha' => 'La fecha es obligatoria. '

        ];


         // creo la validación de datos
         $validateLegajo = Validator::make($request->all(), $rules, $messages);


         $legajo = Legajo::create(array_merge($validateLegajo->validate()));


         return response()->json([
 
             'message' => '¡Historial clínico creado!',
             'legajo' => $legajo
 
         ], 201);


    }

    

    public function show($id)
    {
        //
    }

    

    public function update(Request $request, $id)
    {
        //
    }

    

    public function destroy($id)
    {
        //
    }
}

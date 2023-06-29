<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Legajo;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LegajoResource;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;


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
        $legajo = Legajo::findOrFail($id);

        return response()->json([

            //'message' => '¡Aqui esta tu legajo!',
            'legajo' => $legajo

        ], 201);
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

        $pdf = Pdf::loadView('prueba2', compact('legajos', 'legajo'))->setPaper('a4', 'landscape');

        return $pdf->stream('paciente_legajo_unico.pdf');
    }


}

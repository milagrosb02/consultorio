<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TratamientoResource;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TratamientoResource::collection(Tratamiento::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // reglas
        $rules = 
        [

            'nombre' => ['required', 'string', 'max: 70']

        ];


        // mensajes
        $messages = 
        [

            'nombre.required' => 'El tratamiento es requerido. ',

            'nombre.string' => 'El nombre del tratamiento deben ser caracteres alfanuméricos. ',

            'nombre.max' => 'El nombre del tratamiento es demasiado largo. '

        ];


        // creo la validacion de datos
        $validateTratamiento = Validator::make($request->only('nombre'), $rules, $messages);

        // crea el tratamiento
        $tratamiento = Tratamiento::create(array_merge($validateTratamiento->validate()));


        return response()->json([

            'message' => '¡Tratamiento creado!',
            'tratamiento' => $tratamiento

        ], 201);


    }

   

    public function destroy(Request $request, $id)
    {
        $borrar_tratamiento = 
        [
            'nombre' => $request->nombre
        ];

        Tratamiento::whereId($id)->delete($borrar_tratamiento);

        return response()->json([

         'message' => '¡Tratamiento borrado!'
        
        ], 201);
    }


    



    public function buscar_tratamiento($tratamiento)
    {
        $tratamientos = DB::table('tratamientos')
                    ->select('nombre AS tratamiento')
                    ->where('nombre', 'LIKE', '%'.$tratamiento.'%')
                    ->get();

        return response()->json($tratamientos);

    }

   
}

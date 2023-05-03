<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TratamientoResource;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\Validator;

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
        $this->validate($request, [

            'nombre' => 'string|max:70'

        ]);


        $modificar_tratamiento = 
        [

            'nombre' => $request->nombre

        ];


        $tratamiento = Tratamiento::where('id', $id)->firstOrFail();

        $tratamiento->update($modificar_tratamiento);

        return response()->json([

            'message' => '¡Tratamiento modificado!',
            'tratamiento' => $tratamiento

        ], 201);
        
    }

   
}

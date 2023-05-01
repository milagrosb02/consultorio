<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use Illuminate\Support\Facades\Validator;


class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

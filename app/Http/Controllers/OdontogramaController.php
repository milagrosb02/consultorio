<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Odontograma;
use Carbon\Carbon;
use App\Http\Resources\OdontogramaResource;


class OdontogramaController extends Controller
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
        // reglas
        $rules = 
        [
            'pieza_id' => ['required'],

            'tratamiento_id' => ['nullable'],

            'diagnostico' => ['string', 'required'],

            'anomalia_color_id' => ['required'],

            'legajo_id' => ['required'],

            'cara_odontograma_id' => ['required'],

        ];


        $messages = 
        [
            'pieza_id.required' => ['Debe seleccionar una pieza dental. '],

            'diagnostico.required' => ['Debes escribir un diagnostico sobre el estado de este diente. '],

            'anomalia_color_id.required' => ['Selecciona un color de referencia. '],

            'legajo_id.required' => ['Selecciona al legajo que pertenece este odontograma. '],

            'cara_odontograma_id.required' => ['Debe seleccionar la cara a la que pertenecese esta pieza. ']

        ];


        $validateOdontograma = Validator::make($request->all(), $rules, $messages);

          // Verificar si la validación falla
          if ($validateOdontograma->fails()) 
          {
              return response()->json
              ([
                  'message' => 'Error en los datos enviados. Repita el proceso. ',
                  'errors' => $validateOdontograma->errors(),
              ], 400);
          }


          // si el estatus es 200, se crea el odonto
          $odontograma = Odontograma::create(array_merge($validateOdontograma->validate(), [

           // 'fecha' => Carbon::now()->format('Y-m-d') 

         ]));

         return response()->json([
 
            'message' => '¡Odontograma creado!',
            'odontograma' => $odontograma

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

  
}

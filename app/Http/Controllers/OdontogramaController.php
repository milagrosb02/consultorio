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
        return OdontogramaResource::collection(Odontograma::with('pieza', 'tratamiento', 'anomalias_colores', 'legajo', 'cara_odontograma')->get());
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
          $odontograma = Odontograma::create(array_merge($validateOdontograma->validate()));

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
    public function show($paciente_id)
    {
        
        $odontograma = Odontograma::join('legajos', 'odontogramas.legajo_id', '=', 'legajos.id')

                    ->join('pacientes', 'legajos.paciente_id', '=', 'pacientes.id')
                    ->where('pacientes.id', $paciente_id)
                    ->select('odontogramas.*')
                    ->get();

        if ($odontograma->isEmpty()) 
        {
            return response()->json
            ([
                'message' => 'Aún no posees un odontograma.'
            ], 404);


        } 
        else 
        {

            // Personalizar el formato de la hora en cada objeto Odontograma
        $odontograma->map(function ($item) {
            $item->created_at = Carbon::parse($item->created_at)->format('Y-m-d H:i');
            return $item;
        });

            return response()->json([
                'message' => '¡Aquí está tu odontograma!',
                'odontograma' => $odontograma
            ], 201);
        }

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

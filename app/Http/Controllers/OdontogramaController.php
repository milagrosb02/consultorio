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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OdontogramaResource::collection(Odontograma::with('piezas', 'tratamiento', 'anomalia_color', 'legajo', 'cara_odontograma')->get());
    }

    

    public function store(Request $request)
    {
        // reglas
        $rules = 
        [

            'paciente_id' => ['required'],

            'pieza_id' => ['required', 'array'],

            'tratamiento_id' => ['required'],

            'anomalia_color_id' => ['required'],

            'cara_odontograma_id' => ['required'],

            'diagnostico' => ['string', 'required'],

            
        ];


        $messages = 
        [

            'paciente_id.required' => ['Debe seleccionar el paciente. '],

            'pieza_id.required' => ['Debe seleccionar una pieza dental. '],

            'diagnostico.required' => ['Debes escribir un diagnostico sobre el estado de este diente. '],

            'tratamiento_id.required' => ['Debe seleccionar un tratamiento.'],

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


          // Si el estatus es 200, se crea el odontograma para cada pieza seleccionada
            $piezasSeleccionadas = $request->input('pieza_id');
            $odontogramas = [];


             
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
                'odontogramas' => $odontogramas,
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
        
        $odontograma = Odontograma::where('paciente_id', $paciente_id)->get();


        if ($odontograma->isEmpty()) 
        {
            return response()->json
            ([

                'message' => 'Aún no posees un odontograma.'

            ], 404);

        } 
        else 
        {
            return response()->json
            ([

                'message' => '¡Aquí está tu odontograma!',

                'odontograma' => $odontograma

            ], 201);
        }


    }


    public function showOdontoAdmin($paciente_id)
    {
        $odontogramas = Odontograma::with('piezas', 'tratamiento', 'anomalia_color', 'paciente', 'cara_odontograma')
        ->where('paciente_id', $paciente_id)
        //->where('created_at', now())
        ->latest() // Ordenar por fecha_actualizacion en orden descendente
        ->first();
        // falta iteracion 
        $piezas = Pieza::join('odontograma_piezas', 'piezas.id', '=' , 'odontograma_piezas.pieza_id')
        ->join('odontogramas', 'odontograma_piezas.odontograma_id', '=', 'odontogramas.id')
        ->select('odontograma_piezas.pieza_id')
        ->where('paciente_id', $paciente_id)
        ->get();
        
        if (empty($odontogramas)) 
        {
            return response()->json([
                'message' => 'Aún no posees un odontograma.'
            ], 404);
        } else {
            return response()->json([
                'message' => '¡Aquí está tu odontograma!',
                'odontogramas' => $odontogramas,
                'piezas' => $piezas
            ], 201);
        }
    }

    public function update(Request $request, $odontograma_id)
    {

        $modificar_odontograma = $request->only([
            //'pieza_id',
            'tratamiento_id',
            'diagnostico',
            'anomalia_color_id',
            'cara_odontograma_id'
        ]);
    
        $odontograma = Odontograma::where('id', $odontograma_id)->latest()->first();
    
        // Actualizar el odontograma con los datos proporcionados
        $odontograma->update($modificar_odontograma);
    
        // Establecer la fecha de actualización al momento de la actualización
        $odontograma->fecha_actualizacion = now();
        $odontograma->save();
        $piezasSeleccionadas = $request->input('pieza_id');
        $odontograma->piezas()->sync($piezasSeleccionadas);
    
        // Obtener el último registro actualizado del odontograma por fecha de actualización
        $ultimo_odontograma = Odontograma::where('paciente_id', $odontograma->paciente_id)
            ->latest('fecha_actualizacion') // Ordenar por fecha_actualizacion en orden descendente
            ->first();
        
         
            
            
        return response()->json([
            'message' => '¡Odontograma modificado!',
            'odontograma' => $ultimo_odontograma
        ], 200);
    }



    public function generarOdontogramaPDF($paciente_id)
    {
        
        $odontogramas = Odontograma::with('piezas', 'tratamiento', 'anomalia_color', 'paciente', 'cara_odontograma')
                        ->where("paciente_id",$paciente_id)->get();

        //dd($odontogramas);

        $referencias_colores = AnomaliaColor::select('color', 'descripcion')->get();

        $odontograma = Odontograma::with('paciente')->where("paciente_id",$paciente_id)->latest()->first();
        

        $pdf = Pdf::loadView('odonto_paciente', compact('odontogramas', 'odontograma', 'referencias_colores'))
            ->setPaper('a4', 'landscape');
    
        return $pdf->stream('paciente_odontograma_unico.pdf');
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

<?php

namespace App\Http\Controllers;

use App\Models\ObraSociale;
use Illuminate\Http\Request;
use App\Http\Resources\ObraSocialResource;
use Illuminate\Support\Facades\Validator;
use App\Rules\Uppercase;

class ObraSocialController extends Controller
{
    
    public function index()
    {
        return ObraSocialResource::collection(ObraSociale::all());
    }



   
    public function store(Request $request)
    {

        $rules = [

            'obra_social' => ['required', 'string', 'min:3','unique:obra_sociales', new Uppercase]

        ];

        $messages = 
        [

            'obra_social.required' => 'La obra social es obligatoria. ',

            'obra_social.string' => 'La obra social no es válida. Ingresa nuevamente. ',

            'obra_social.min' => 'La obra social no es válida. Ingresa nuevamente. ',

            'obra_social.unique' => 'Esta obra social ya está registrada. Ingresa otra. '

        ];


        $obra_socialValidate = Validator::make($request->only('obra_social'), $rules, $messages);

        $obra_Social = ObraSociale::create(array_merge($obra_socialValidate->validate()));

        return response()->json([

                'message' => '¡Obra Social creada!',
                'obra_social' => $obra_Social
    
             ], 201);
       
        
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $borrar_obraSocial = 
        [
            'obra_social' => $request->obra_social
        ];

        ObraSociale::whereId($id)->delete($borrar_obraSocial);

        return response()->json([

         'message' => '¡Cobertura medica borrada!'
        
        ], 201);
    }
}
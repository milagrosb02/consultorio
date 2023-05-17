<?php

namespace App\Http\Controllers;

use App\Models\ObraSociale;
use Illuminate\Http\Request;
use App\Http\Resources\ObraSocialResource;
use App\Models\Paciente;
use App\Models\User;
use App\Notifications\RecordatorioDeTurnoNotification;
use Illuminate\Support\Facades\Validator;
use App\Rules\Uppercase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Models\Turno;
use Carbon\Carbon;

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


        // NOTIFICACION
        $user = User::find(4);
        $turno = Turno::find(1);
        $turno->load('user','paciente');
        Notification::send($user, new RecordatorioDeTurnoNotification($turno));


        

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



    public function buscar_obra_social($obra_social)
    {
        $obras_sociales = DB::table('obra_sociales')
                    ->select('obra_social AS obra social')
                    ->where('obra_social', 'LIKE', '%'.$obra_social.'%')
                    ->get();

        return response()->json($obras_sociales);
    }

}
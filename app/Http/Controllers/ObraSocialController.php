<?php

namespace App\Http\Controllers;

use App\Models\ObraSociale;
use Illuminate\Http\Request;
use App\Http\Resources\ObraSocialResource;
use Illuminate\Support\Facades\Validator;

class ObraSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ObraSocialResource::collection(ObraSociale::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $validateObraSocial = Validator::make($request->all(), [

            'obra_social' => 'required|min:3'
        ]);

        // si la solicitud no es valida
        if($validateObraSocial->fails()){

            return response()->json($validateObraSocial->errors()->toJson(), 400);

        }

        return new ObraSocialResource(ObraSociale::create($request->all()));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObraSociale $obraSociale)
    {
        $obraSociale->delete();


        return (new ObraSocialResource($obraSociale));
    }
}
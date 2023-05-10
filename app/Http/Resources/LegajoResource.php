<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LegajoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,

            'paciente' => $this->paciente->user->first_name .' '. $this->paciente->user->last_name, 

            'observacion' => $this->descripcion,

            'tratamiento' => $this->tratamientos ?? 'No se realizo un tratamiento. ',

            'fecha' => $this->fecha


        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LegajoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'data' => $this->collection,

            'paciente_id' => $this->paciente_id, 

            'descripcion' => $this->descripcion,

            'tratamiento_id' => $this->tratamiento_id,

            'fecha' => $this->fecha
        ];
    }
}

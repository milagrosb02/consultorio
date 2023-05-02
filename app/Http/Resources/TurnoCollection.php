<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TurnoCollection extends ResourceCollection
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

            'user_id' => $this->user_id,

            'motivo_consulta' => $this->motivo_consulta,

            'especialidad_id' => $this->especialidad_id,

            'fecha' => $this->fecha,

            'hora' => $this->hora

        ];
    }
}

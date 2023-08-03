<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OdontogramaCollection extends ResourceCollection
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

            'piezas' => $this->piezas->pieza,

            'tratamiento_id' => $this->tratamiento_id,

            'diagnostico' => $this->diagnostico,

            'anomalia_color_id' => $this->anomalia_color_id,

            'cara_odontograma_id' => $this->cara_odontograma_id,

            'created_at' => $this->created_at

        ];
    }
}

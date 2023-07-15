<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OdontogramaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[

            'id' => $this->id,

            'pieza nro' => $this->pieza->pieza,   

            "paciente" => $this->legajo->paciente?->user?->first_name .' '. $this->legajo->paciente?->user?->last_name,

            "tratamiento" => $this->tratamiento->tratamiento ?? 'No se realizo un tratamiento. ',

            "diagnostico de la pieza" => $this->diagnostico,

            "color de la pieza" => $this->anomalias_colores->first()->color,

            "fecha y hora" => $this->created_at

        ];
    }
}

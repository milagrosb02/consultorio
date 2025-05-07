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

            'piezas' => $this->piezas->map(function($pieza) {
            return [
                'id' => $pieza->id,
                'pieza' => $pieza->pieza,
            ];
        }),


            "paciente" => $this->paciente?->user?->first_name .' '. $this->paciente?->user?->last_name,

            "tratamiento" => $this->tratamiento?->nombre ?? 'No se realizo un tratamiento. ',

            "diagnostico de la pieza" => $this->diagnostico,

            "color de la pieza" => $this->anomalia_color?->color,


            "descripcion de la pieza" => $this->anomalia_color?->descripcion,



            "cara dental" => $this->cara_odontograma?->nombre,

            "fecha y hora" => $this->created_at

        ];
    }
}

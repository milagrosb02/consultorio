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

            'pieza_id' => $this->pieza_id,

            'legajo_id' => $this->legajo_id,

            'tratamiento_id' => $this->tratamiento_id,

            'diagnostico' => $this->diagnostico,

            'anomalia_color_id' => $this->anomalia_color_id,

            'created_at' => $this->created_at

        ];
    }
}

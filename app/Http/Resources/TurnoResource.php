<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TurnoResource extends JsonResource
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

            'profesional' => $this->user->first_name .' '. $this->user->last_name,

            'motivo_consulta' => $this->motivo_consulta ?? 'No se selecciono un motivo de consulta. ',

            'especialidad' => $this->especialidad ?? 'No se selecciono una especialidad. ',

            'fecha' => $this->fecha,

            'hora' => $this->hora

        ];
    }
}

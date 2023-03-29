<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PacienteResource extends JsonResource
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

               'id' => $this->user_id,
               'nombres' => (new UserResource($this->first_name)),
               'apellidos' => (new UserResource($this->last_name)),
               'email' => (new UserResource($this->email)),
               'telefono' => $this->phone,
               'obra social' => (new ObraSocialResource($this->obra_social))

           

        ];
    }
}

// consulta completa
// SELECT first_name, last_name, email, phone, obra_social_id
// FROM users u
// INNER JOIN pacientes p
// ON u.id = p.user_id;
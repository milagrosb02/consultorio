<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legajo extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'descripcion', 'tratamiento_id', 'fecha'];


    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class);
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'id');
    }

}

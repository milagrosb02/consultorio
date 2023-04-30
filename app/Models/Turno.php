<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;

class Turno extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['paciente_id', 'fecha', 'hora', 'motivo_consulta', 'especialidad_id', 'user_id'];
}

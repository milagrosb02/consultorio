<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Turno extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','fecha', 'hora', 'motivo_consulta', 'especialidad_id', 'paciente_id',];

    protected $dates = ['deleted_at'];

    // relacion con usuarios
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }




    // relacion con especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }
}

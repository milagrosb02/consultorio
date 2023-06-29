<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legajo extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'descripcion', 'tratamiento_id', 'fecha'];

    protected $dates = ['fecha'];

    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'tratamiento_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }


    
     public function profesional()
     {
         return $this->belongsTo(User::class, 'user_id');
     }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraSociale extends Model
{
    use HasFactory;

    protected $fillable = ['id','obra_social'];


    public function paciente()
    {
        return $this->hasMany(Paciente::class, 'id');
    }

}
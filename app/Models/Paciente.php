<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'phone', 'obra_social_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function obra_social()
    {
        return $this->belongsTo(ObraSociale::class, 'obra_social_id');
    }


    public function legajo()
    {
        return $this->hasMany(Legajo::class);
    }


    // esto lo agregue porque no estaba, para que funcione la validacion
    public function turnos()
    {
        return $this->hasMany(Turno::class, 'paciente_id');
    }


    public function registrarTurno()
    {
        $ultimoTurno = $this->turnos()->latest()->first();

        if ($ultimoTurno) 
        {
            return Carbon::parse($ultimoTurno->fecha)->isPast();
        }

        return true;
    }


}

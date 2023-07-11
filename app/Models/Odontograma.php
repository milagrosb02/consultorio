<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odontograma extends Model
{
    use HasFactory;

    protected $fillable = ['pieza_id', 'tratamiento_id', 'diagnostico', 'anomalia_color_id', 'legajo_id', 'cara_odontograma_id'];

    protected $date =['created_at'];


    public function piezas()
    {
        return $this->hasMany(Pieza::class, 'pieza_id');
    }


    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class, 'tratamiento_id');
    }


    public function anomalias_colores()
    {
        return $this->hasMany(AnomaliaColor::class, 'anomalia_color_id');   
    }


    public function legajo()
    {
        return $this->hasOne(Legajo::class, 'legajo_id');
    }


    public function cara_odontograma()
    {
        return $this->hasMany(CaraOdontograma::class, 'cara_odontograma_id'); 
    }

}

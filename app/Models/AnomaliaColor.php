<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnomaliaColor extends Model
{
    use HasFactory;

    public $table = "anomalias_colores";


    public function odontograma()
    {
        return $this->belongsTo(Odontograma::class);
    }


    // rojo: patologia o lesion, representa lo que esta pendiente de hacer
    // azul: tratamiento que el paciente ya tiene hecho
    // verde: caries radiograficas
    // amarillo: sellado de fosas y fisuras
    // negro: ausencias naturales 


}

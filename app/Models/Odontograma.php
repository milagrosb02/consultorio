<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Odontograma extends Model
{
    use HasFactory;

    protected $fillable = ['pieza_id', 'tratamiento_id', 'diagnostico', 'anomalia_color_id', 'legajo_id', 'cara_odontograma_id', 'created_at'];

    
    public function toArray()
    {
        $attributes = $this->attributesToArray();
        $attributes['created_at'] = Carbon::parse($this->created_at)->format('Y-m-d H:i');
        return $attributes;
    }

    public function pieza()
    {
        return $this->belongsTo(Pieza::class, 'pieza_id');
    }
    


    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'tratamiento_id');
    }


    public function anomalias_colores()
    {
        return $this->hasMany(AnomaliaColor::class, 'id');   
    }


    public function legajo()
    {
        return $this->belongsTo(Legajo::class, 'legajo_id');
    }



    public function cara_odontograma()
    {
        return $this->hasMany(CaraOdontograma::class, 'id'); 
    }





}

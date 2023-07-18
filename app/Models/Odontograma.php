<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Odontograma extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id','pieza_id', 'tratamiento_id', 'diagnostico', 'anomalia_color_id', 'cara_odontograma_id', 'created_at'];

    
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


    public function anomalia_color()
    {
        return $this->belongsTo(AnomaliaColor::class, 'anomalia_color_id');   
    }


    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }



    public function cara_odontograma()
    {
        return $this->belongsTo(CaraOdontograma::class); 
    }





}

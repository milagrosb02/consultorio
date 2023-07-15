<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    protected $fillable = ['id','nombre'];


    public function legajo()
    {
        return $this->hasMany(Legajo::class, 'id');
    }


    public function odontogramas()
    {
        return $this->hasMany(Odontograma::class, 'tratamiento_id');
    }

}

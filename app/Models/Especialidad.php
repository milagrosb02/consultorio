<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    public $table = "especialidades";

    protected $fillable = ['especialidad'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'profesional_especialidades', 'especialidad_id', 'user_id');
    }


    public function turno()
    {
        return $this->hasOne(Turno::class);
    }

}

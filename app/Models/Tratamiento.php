<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];


    public function legajo()
    {
        return $this->belongsTo(Legajo::class, 'tratamiento_id');
    }


}

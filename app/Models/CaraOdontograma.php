<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaraOdontograma extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nombre'];

    public $table = "caras_odontograma";
    

    public function odontograma()
    {
        return $this->belongsTo(Odontograma::class, 'id');
    }
}

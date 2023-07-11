<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'pieza'];


    public function odontograma()
    {
        return $this->belongsTo(Odontograma::class);
    }
}

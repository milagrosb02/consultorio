<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}

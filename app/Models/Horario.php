<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'medico_id',
        'dia',
        'hora_inicio',
        'hora_fin',
    ];

    public function medico() { 
        return $this->belongsTo(Doctor::class, 'medico_id'); 
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    public function medicos() {
        return $this->belongsToMany(Doctor::class, 'medico_especialidad'); 
    }
}

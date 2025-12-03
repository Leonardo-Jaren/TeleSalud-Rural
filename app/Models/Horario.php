<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public function medico() { 
        return $this->belongsTo(Doctor::class); 
    }
}

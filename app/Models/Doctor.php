<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Doctor extends Model
{
    /**
     * La tabla asociada al modelo.
     */
    protected $table = 'medicos';

    protected $fillable = [
        'usuario_id',
        'codigo_cmp',
        'biografia',
    ];

    /**
     * Obtener el usuario asociado al médico.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relación: Un médico tiene muchos horarios
    public function horarios() {
        return $this->hasMany(Horario::class);
    }
    // Relación: Un médico tiene muchas especialidades
    public function especialidades() {
        return $this->belongsToMany(Especialidad::class, 'medico_especialidad');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Appointment;

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
        return $this->hasMany(Horario::class, 'medico_id');
    }
    // Relación: Un médico tiene muchas especialidades
    public function especialidades()
    {
        return $this->belongsToMany(
            Especialidad::class,
            'medico_especialidad',  // tabla pivote
            'medico_id',            // FK del modelo actual (Doctor) en la tabla pivote
            'especialidad_id',      // FK del modelo relacionado (Especialidad)
            'id',                   // clave local en la tabla 'medicos'
            'id'                    // clave local en la tabla 'especialidades'
        );
    }

    /**
     * Obtener las citas asociadas al médico (a través del usuario asociado)
     */
    public function appointments()
    {
        // La tabla appointments almacena medico_id que referencia a users.id
        // En el modelo Doctor, la clave local del usuario es 'usuario_id'
        return $this->hasMany(Appointment::class, 'medico_id', 'usuario_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    /**
     * La tabla asociada al modelo.
     */
    protected $table = 'pacientes';

    protected $fillable = [
        'usuario_id',
        'direccion',
        'fecha_nacimiento',
        'tipo_sangre',
        'alergias',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    /**
     * Obtener el usuario asociado al paciente.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}

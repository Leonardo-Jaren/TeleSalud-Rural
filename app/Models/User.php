<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'telefono',
        'documento_identidad',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Obtener el perfil de médico asociado (si existe).
     */
    public function medico(): HasOne
    {
        return $this->hasOne(Doctor::class, 'usuario_id');
    }

    /**
     * Obtener el perfil de paciente asociado (si existe).
     */
    public function paciente(): HasOne
    {
        return $this->hasOne(Patient::class, 'usuario_id');
    }

    /**
     * Verificar si el usuario es administrador.
     */
    public function isAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    /**
     * Verificar si el usuario es médico.
     */
    public function isMedico(): bool
    {
        return $this->rol === 'medico';
    }

    /**
     * Verificar si el usuario es paciente.
     */
    public function isPaciente(): bool
    {
        return $this->rol === 'paciente';
    }

    /**
     * Verificar si el usuario tiene alguno de los roles especificados.
     */
    public function hasRole(...$roles): bool
    {
        return in_array($this->rol, $roles);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'telemedicine_link',
        'paciente_id',
        'medico_id',
        'scheduled_at',
        'motivo',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    protected $appends = [
        'telemedicine_link_auto',
    ];

    // Relaciones
    public function paciente()
    {
        return $this->belongsTo(\App\Models\User::class, 'paciente_id');
    }

    public function medico()
    {
        return $this->belongsTo(\App\Models\User::class, 'medico_id');
    }

    public function getTelemedicineLinkAutoAttribute()
    {

        if (!empty($this->attributes['telemedicine_link'])) {
            return $this->attributes['telemedicine_link'];
        }

        if (($this->attributes['type'] ?? null) !== 'telemedicina') {
            return null;
        }

        if (!$this->exists) {
            
            return null;
        }

       
        $base = config('app.telemed_base', 'https://meet.jit.si');
        $room = 'TeleSaludRural-Cita-' . $this->id;
        $link = rtrim($base, '/') . '/' . $room;

   
        if (Schema::hasColumn($this->getTable(), 'telemedicine_link')) {
            $this->attributes['telemedicine_link'] = $link;
            $this->saveQuietly(); 
        }

        return $link;
    }

   
    public function getTelemedicineLinkAttribute($value)
    {
        return $value ?: $this->telemedicine_link_auto;
    }
}

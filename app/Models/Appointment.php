<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'schedule_date',
        'schedule_time',
        'type',
        'status',
        'link_telemedicina',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function getLinkTelemedicinaAttribute($value)
    {
        if (! empty($value)) {
            return $value;
        }

        if (($this->attributes['type'] ?? null) !== 'telemedicina') {
            return null;
        }

        if (! $this->exists) {
            return null;
        }

        $base = config('app.telemed_base', 'https://meet.jit.si');
        $room = 'TeleSaludRural-Cita-' . $this->id;
        $link = rtrim($base, '/') . '/' . $room;

        if (Schema::hasColumn($this->getTable(), 'link_telemedicina')) {
            $this->attributes['link_telemedicina'] = $link;
            $this->saveQuietly();
        }

        return $link;
    }
}

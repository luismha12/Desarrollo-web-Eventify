<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    /**
     * Campos asignables en el modelo.
     *
     * @var array
     */
    protected $fillable = ['event_id', 'name', 'email'];

    /**
     * Relación con el modelo Event.
     * Un asistente pertenece a un evento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

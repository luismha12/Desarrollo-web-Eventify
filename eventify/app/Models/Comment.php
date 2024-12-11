<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Campos asignables en el modelo.
     *
     * @var array
     */
    protected $fillable = ['event_id', 'user_id', 'comment', 'rating'];

    /**
     * Relación con el modelo Event.
     * Un comentario pertenece a un evento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relación con el modelo User.
     * Un comentario pertenece a un usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

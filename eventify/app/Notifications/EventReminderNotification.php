<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminderNotification extends Notification
{
    use Queueable;

    /**
     * Detalles del evento.
     *
     * @var \App\Models\Event
     */
    protected $event;

    /**
     * Crear una nueva instancia de notificación.
     *
     * @param \App\Models\Event $event
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Determinar los canales de entrega.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Obtener la representación del mensaje para correo.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recordatorio del Evento: ' . $this->event->name)
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Estamos emocionados de recordarte que el evento "' . $this->event->name . '" está próximo.')
            ->line('📅 Fecha: ' . $this->event->date->format('d/m/Y'))
            ->line('📍 Ubicación: ' . $this->event->location)
            ->action('Ver Detalles del Evento', url('/events/' . $this->event->id))
            ->line('¡Esperamos verte allí! ¡No faltes!');
    }

    /**
     * Representación del mensaje en array.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'event_name' => $this->event->name,
            'event_date' => $this->event->date,
            'event_location' => $this->event->location,
        ];
    }
}


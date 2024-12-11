<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventUpdateNotification extends Notification
{
    use Queueable;

    /**
     * Detalles del evento actualizado.
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
     * Representación del mensaje para correo.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Actualización del Evento: ' . $this->event->name)
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('El evento "' . $this->event->name . '" ha sido actualizado.')
            ->line('📅 Nueva Fecha: ' . $this->event->date->format('d/m/Y'))
            ->line('📍 Nueva Ubicación: ' . $this->event->location)
            ->line('📝 Detalles: ' . $this->event->description)
            ->action('Ver Detalles del Evento', url('/events/' . $this->event->id))
            ->line('¡Gracias por estar atento a las actualizaciones!');
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
            'event_description' => $this->event->description,
        ];
    }
}


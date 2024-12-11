<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketPurchaseNotification extends Notification
{
    use Queueable;

    /**
     * Detalles del ticket comprado.
     *
     * @var \App\Models\Ticket
     */
    protected $ticket;

    /**
     * Crear una nueva instancia de notificación.
     *
     * @param \App\Models\Ticket $ticket
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
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
            ->subject('Compra de Entradas Confirmada')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Gracias por tu compra. Aquí están los detalles de tu entrada:')
            ->line('🎟 Evento: ' . $this->ticket->event->name)
            ->line('📅 Fecha: ' . $this->ticket->event->date->format('d/m/Y'))
            ->line('📍 Ubicación: ' . $this->ticket->event->location)
            ->line('🔑 Código de Entrada: ' . $this->ticket->code)
            ->action('Ver Detalles del Evento', url('/events/' . $this->ticket->event_id))
            ->line('¡Te esperamos en el evento!');
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
            'ticket_id' => $this->ticket->id,
            'event_name' => $this->ticket->event->name,
            'event_date' => $this->ticket->event->date,
            'event_location' => $this->ticket->event->location,
            'ticket_code' => $this->ticket->code,
        ];
    }
}

<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Event;
use App\Notifications\EventReminderNotification;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos Artisan en tu aplicación.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Definir la programación del cron.
     */
    protected function schedule(Schedule $schedule)
    {
        // Enviar recordatorios de eventos un día antes del evento
        $schedule->call(function () {
            $events = Event::where('date', '>=', now())
                ->where('date', '<=', now()->addDays(1)) // Eventos que ocurren dentro de las próximas 24 horas
                ->get();

            foreach ($events as $event) {
                foreach ($event->attendees as $attendee) {
                    $attendee->notify(new EventReminderNotification($event));
                }
            }
        })->daily(); // Se ejecuta diariamente
    }
}

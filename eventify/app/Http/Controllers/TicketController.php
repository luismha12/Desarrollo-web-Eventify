<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketPurchaseNotification;

class TicketController extends Controller
{
    /**
     * Mostrar la lista de tickets.
     */
    public function index()
    {
        $tickets = Ticket::with(['event', 'user'])->get(); // Obtener todos los tickets con sus relaciones
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Mostrar el formulario para crear un ticket.
     */
    public function create()
    {
        $events = Event::all(); // Obtener todos los eventos
        $users = User::all(); // Obtener todos los usuarios
        return view('tickets.create', compact('events', 'users'));
    }

    /**
     * Almacenar un nuevo ticket.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $ticket = Ticket::create($request->all()); // Crear el ticket con los datos validados

        // Notificar al usuario
        $user = User::findOrFail($request->user_id);
        Notification::send($user, new TicketPurchaseNotification($ticket));

        return redirect()->route('tickets.index')->with('success', 'Ticket creado exitosamente y notificación enviada.');
    }

    /**
     * Mostrar los detalles de un ticket específico.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with(['event', 'user'])->findOrFail($id); // Buscar ticket con relaciones
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Mostrar el formulario para editar un ticket.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $events = Event::all();
        $users = User::all();
        return view('tickets.edit', compact('ticket', 'events', 'users'));
    }

    /**
     * Actualizar un ticket existente.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket actualizado exitosamente.');
    }

    /**
     * Eliminar un ticket.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket eliminado exitosamente.');
    }

    /**
     * Procesar la compra de tickets.
     */
    public function processPurchase(Request $request, Event $event)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $tickets = [];
        for ($i = 0; $i < $request->quantity; $i++) {
            $tickets[] = Ticket::create([
                'event_id' => $event->id,
                'user_id' => auth()->id(),
                'status' => 'paid',
            ]);
        }

        // Notificar al usuario con todos los tickets comprados
        Notification::send(auth()->user(), new TicketPurchaseNotification($tickets));

        return redirect()->route('tickets.index')->with('success', 'Entradas compradas exitosamente y notificaciones enviadas.');
    }

    /**
     * Mostrar el formulario para comprar un ticket.
     */
    public function buy(Event $event)
    {
        return view('tickets.buy', compact('event'));
    }
}

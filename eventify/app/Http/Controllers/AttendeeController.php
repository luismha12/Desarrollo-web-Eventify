<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * Mostrar lista de asistentes para un evento.
     *
     * @param int $eventId
     * @return \Illuminate\View\View
     */
    public function index($eventId)
    {
        $event = Event::findOrFail($eventId);
        $attendees = Attendee::where('event_id', $eventId)->get();

        return view('attendees.index', compact('attendees', 'eventId', 'event'));
    }

    /**
     * Mostrar formulario para agregar un asistente.
     *
     * @param int $eventId
     * @return \Illuminate\View\View
     */
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);

        return view('attendees.create', compact('event'));
    }

    /**
     * Guardar un nuevo asistente.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $eventId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:attendees,email',
        ]);

        $event = Event::findOrFail($eventId);
        $event->attendees()->create($request->all());

        return redirect()->route('attendees.index', $eventId)
            ->with('success', 'Asistente agregado con éxito.');
    }

    /**
     * Mostrar formulario para editar un asistente.
     *
     * @param int $eventId
     * @param int $attendeeId
     * @return \Illuminate\View\View
     */
    public function edit($eventId, $attendeeId)
    {
        $event = Event::findOrFail($eventId);
        $attendee = Attendee::where('event_id', $eventId)->findOrFail($attendeeId);

        return view('attendees.edit', compact('attendee', 'eventId', 'event'));
    }

    /**
     * Actualizar la información de un asistente.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $eventId
     * @param int $attendeeId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $eventId, $attendeeId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:attendees,email,' . $attendeeId,
        ]);

        $attendee = Attendee::where('event_id', $eventId)->findOrFail($attendeeId);
        $attendee->update($request->all());

        return redirect()->route('attendees.index', $eventId)
            ->with('success', 'Asistente actualizado con éxito.');
    }

    /**
     * Eliminar un asistente de un evento.
     *
     * @param int $eventId
     * @param int $attendeeId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($eventId, $attendeeId)
    {
        $attendee = Attendee::where('event_id', $eventId)->findOrFail($attendeeId);
        $attendee->delete();

        return redirect()->route('attendees.index', $eventId)
            ->with('success', 'Asistente eliminado con éxito.');
    }
}

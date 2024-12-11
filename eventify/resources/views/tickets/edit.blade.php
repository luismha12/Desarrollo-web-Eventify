@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar ticket</h1>
        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="event_id" class="form-label">Evento</label>
                <select name="event_id" id="event_id" class="form-select" required>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ $ticket->event_id == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Usuario</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $ticket->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                    <option value="paid" {{ $ticket->status == 'paid' ? 'selected' : '' }}>Pagado</option>
                    <option value="cancelled" {{ $ticket->status == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar ticket</button>
        </form>
    </div>
@endsection

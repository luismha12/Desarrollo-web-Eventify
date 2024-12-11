@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles del ticket</h1>
        <p><strong>ID:</strong> {{ $ticket->id }}</p>
        <p><strong>Evento:</strong> {{ $ticket->event->name }}</p>
        <p><strong>Usuario:</strong> {{ $ticket->user->name }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($ticket->status) }}</p>
        <p><strong>Creado:</strong> {{ $ticket->created_at }}</p>
        <p><strong>Actualizado:</strong> {{ $ticket->updated_at }}</p>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection

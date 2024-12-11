@extends('layouts.app')

@section('title', $event->name)

@section('content')
    <div class="container my-5">
        <div class="text-center mb-4">
            @if($event->banner)
                <img src="{{ asset('storage/' . $event->banner) }}" class="img-fluid rounded" alt="Banner del Evento" style="max-height: 400px; object-fit: cover;">
            @else
                <div class="bg-secondary text-white py-5 rounded">
                    <h2>Banner no disponible</h2>
                </div>
            @endif
        </div>

        <h1 class="text-primary">{{ $event->name }}</h1>
        <hr>

        <div class="mb-4">
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
            <p><strong>Ubicación:</strong> {{ $event->location }}</p>
        </div>

        @if($event->logo)
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $event->logo) }}" alt="Logotipo del Evento" class="img-thumbnail" style="max-height: 150px;">
            </div>
        @else
            <div class="text-center mb-4">
                <div class="bg-light py-3 border rounded">
                    <p class="text-muted">Logotipo no disponible</p>
                </div>
            </div>
        @endif

        @if($event->custom_description)
            <div class="mb-4">
                <h3>Descripción del Evento</h3>
                <p>{{ $event->custom_description }}</p>
            </div>
        @else
            <div class="alert alert-info">No hay descripción personalizada para este evento.</div>
        @endif

        <div class="d-flex justify-content-between">
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Editar Evento</a>
        </div>
    </div>
@endsection

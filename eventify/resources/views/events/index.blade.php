@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-primary">Gestión de Eventos</h1>
        <a href="{{ route('events.create') }}" class="btn btn-success mb-3">Crear Evento</a>

        @if ($events->isEmpty())
            <div class="alert alert-info">No hay eventos disponibles.</div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Ubicación</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                        <td>{{ $event->location }}</td>
                        <td class="text-center">
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Lista de Asistentes')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-6 text-primary">Asistentes al Evento</h1>
            <a href="{{ route('attendees.create', $eventId) }}" class="btn btn-success btn-lg">
                <i class="bi bi-person-plus-fill"></i> Agregar Asistente
            </a>
        </div>

        @if($attendees->isEmpty())
            <div class="alert alert-warning text-center">
                <h4 class="alert-heading">No hay asistentes registrados</h4>
                <p>Actualmente no se han registrado asistentes para este evento. ¡Sé el primero en agregar uno!</p>
            </div>
        @else
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Lista de Asistentes</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attendees as $attendee)
                            <tr>
                                <td>{{ $loop->iteration }}</td> <!-- Usar $loop->iteration para numeración -->
                                <td>{{ $attendee->name }}</td>
                                <td>{{ $attendee->email }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('attendees.edit', [$eventId, $attendee->id]) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-fill"></i> Editar
                                        </a>
                                        <form action="{{ route('attendees.destroy', [$eventId, $attendee->id]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este asistente?')">
                                                <i class="bi bi-trash-fill"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection

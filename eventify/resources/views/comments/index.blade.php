@extends('layouts.app')

@section('title', 'Comentarios')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-primary">Lista de Comentarios</h1>
        <a href="{{ route('comments.create') }}" class="btn btn-success mb-3">Añadir Comentario</a>

        @if ($comments->isEmpty())
            <div class="alert alert-info">No hay comentarios disponibles.</div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Usuario</th>
                    <th>Comentario</th>
                    <th>Calificación</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->event->name }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ Str::limit($comment->content, 50) }}</td>
                        <td class="text-center">{{ $comment->rating }} / 5</td>
                        <td class="text-center">
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este comentario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

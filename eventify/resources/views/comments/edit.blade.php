@extends('layouts.app')

@section('title', 'Editar Comentario')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-primary">Editar Comentario</h1>
        <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="event_id" class="form-label">Evento</label>
                <select name="event_id" id="event_id" class="form-select" required>
                    <option value="" disabled>Selecciona un evento</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}" {{ $comment->event_id == $event->id ? 'selected' : '' }}>
                            {{ $event->name }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona un evento válido.
                </div>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Usuario</label>
                <input type="number" name="user_id" id="user_id" class="form-control" value="{{ $comment->user_id }}" required placeholder="ID del usuario">
                <div class="invalid-feedback">
                    Por favor, ingresa un ID de usuario válido.
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Comentario</label>
                <textarea name="content" id="content" class="form-control" rows="4" required placeholder="Escribe tu comentario aquí">{{ $comment->content }}</textarea>
                <div class="invalid-feedback">
                    Por favor, escribe un comentario.
                </div>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Calificación</label>
                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" value="{{ $comment->rating }}" required placeholder="1 - 5">
                <div class="invalid-feedback">
                    Por favor, ingresa una calificación entre 1 y 5.
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('comments.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        // Validación de formulario Bootstrap
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection
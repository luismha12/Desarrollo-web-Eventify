@extends('layouts.app')

@section('title', 'Editar Asistente')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Editar Asistente</h1>

        <form action="{{ route('attendees.update', ['eventId' => $eventId, 'attendeeId' => $attendee->id]) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    value="{{ $attendee->name }}"
                    required>
                <div class="invalid-feedback">
                    Por favor, ingresa un nombre válido.
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="{{ $attendee->email }}"
                    required>
                <div class="invalid-feedback">
                    Por favor, ingresa un correo electrónico válido.
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <a href="{{ route('attendees.index', $eventId) }}" class="btn btn-secondary">Cancelar</a>
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

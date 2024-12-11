@extends('layouts.app')

@section('title', 'Agregar Asistente')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Agregar Asistente al Evento: <strong>{{ $event->name }}</strong></h1>

        <form action="{{ route('attendees.store', $event->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback">
                    Por favor ingresa un nombre válido.
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">
                    Por favor ingresa un correo electrónico válido.
                </div>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('attendees.index', $event->id) }}" class="btn btn-secondary">Cancelar</a>
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

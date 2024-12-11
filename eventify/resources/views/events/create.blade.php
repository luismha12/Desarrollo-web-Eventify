@extends('layouts.app')

@section('title', 'Crear Evento')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-primary">Crear Evento</h1>
        <form action="{{ route('events.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Evento</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Introduce el nombre del evento">
                <div class="invalid-feedback">
                    Por favor, ingresa un nombre para el evento.
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Escribe una breve descripción"></textarea>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="date" name="date" required>
                <div class="invalid-feedback">
                    Por favor, selecciona una fecha para el evento.
                </div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" required placeholder="Introduce la ubicación">
                <div class="invalid-feedback">
                    Por favor, ingresa una ubicación para el evento.
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar Evento</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancelar</a>
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

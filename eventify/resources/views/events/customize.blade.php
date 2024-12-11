@extends('layouts.app')

@section('title', 'Personalizar Evento')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-primary">Personalizar Evento: {{ $event->name }}</h1>
        <form action="{{ route('events.customize', $event->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="logo" class="form-label">Logotipo del Evento</label>
                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                <div class="form-text">Sube un logotipo en formato JPEG, PNG o JPG. Tamaño máximo: 2MB.</div>
            </div>

            <div class="mb-3">
                <label for="banner" class="form-label">Banner del Evento</label>
                <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
                <div class="form-text">Sube un banner en formato JPEG, PNG o JPG. Tamaño máximo: 2MB.</div>
            </div>

            <div class="mb-3">
                <label for="custom_description" class="form-label">Descripción Personalizada</label>
                <textarea class="form-control" id="custom_description" name="custom_description" rows="5" placeholder="Añade una descripción única para tu evento">{{ $event->custom_description }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar Cambios</button>
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

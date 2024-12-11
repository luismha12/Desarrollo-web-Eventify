@extends('layouts.app')

@section('title', 'Comprar Entradas')

@section('content')
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Comprar Entradas para {{ $event->name }}</h2>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>Fecha del evento:</strong> {{ $event->date }}</p>
                <p class="mb-2"><strong>Ubicación:</strong> {{ $event->location }}</p>
                <p class="mb-4"><strong>Precio por entrada:</strong> ${{ number_format($event->price, 2) }} USD</p>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('tickets.processPurchase', $event->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Cantidad de Entradas</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 mb-3">
                        <i class="fas fa-ticket-alt"></i> Comprar con Stripe
                    </button>

                    <script
                        src="https://checkout.stripe.com/checkout.js"
                        class="stripe-button"
                        data-key="{{ env('STRIPE_KEY') }}"
                        data-amount="{{ $event->price * 100 }}"
                        data-name="Eventify"
                        data-description="Compra de entradas para {{ $event->name }}"
                        data-image="https://yourwebsite.com/logo.png"
                        data-currency="usd"
                        data-locale="auto">
                    </script>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tickets</h1>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Create New Ticket</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Event</th>
                <th>User</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->event->name }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ ucfirst($ticket->status) }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

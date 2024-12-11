<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AttendeeController;

// Rutas para eventos
Route::resource('events', EventController::class);
Route::get('/events/{id}/customize', [EventController::class, 'showCustomizeForm'])->name('events.customizeForm');
Route::put('/events/{id}/customize', [EventController::class, 'customize'])->name('events.customize');

// Rutas para tickets
Route::resource('tickets', TicketController::class);
Route::get('/tickets/{event}/buy', [TicketController::class, 'buy'])->name('tickets.buy');
Route::post('/tickets/{event}/buy', [TicketController::class, 'processPurchase'])->name('tickets.processPurchase');

// Rutas para comentarios
Route::resource('comments', CommentController::class);

// Rutas para asistentes
Route::prefix('events/{eventId}/attendees')->group(function () {
    Route::get('/', [AttendeeController::class, 'index'])->name('attendees.index');
    Route::get('/create', [AttendeeController::class, 'create'])->name('attendees.create');
    Route::post('/', [AttendeeController::class, 'store'])->name('attendees.store');
    Route::delete('/{attendeeId}', [AttendeeController::class, 'destroy'])->name('attendees.destroy');
});
Route::get('/events/{eventId}/attendees/{attendeeId}/edit', [AttendeeController::class, 'edit'])->name('attendees.edit');
Route::put('/events/{eventId}/attendees/{attendeeId}', [AttendeeController::class, 'update'])->name('attendees.update');
Route::get('/events/{event}/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/events/{event}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::prefix('events/{event}')->group(function () {
    Route::get('comments', [CommentController::class, 'index'])->name('events.comments.index'); // Listar comentarios de un evento
    Route::get('comments/create', [CommentController::class, 'create'])->name('events.comments.create'); // Formulario para crear un comentario
    Route::post('comments', [CommentController::class, 'store'])->name('events.comments.store'); // Guardar comentario
    Route::get('comments/{comment}', [CommentController::class, 'show'])->name('events.comments.show'); // Mostrar un comentario específico
    Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('events.comments.edit'); // Formulario para editar un comentario
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('events.comments.update'); // Actualizar comentario
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('events.comments.destroy'); // Eliminar comentario
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

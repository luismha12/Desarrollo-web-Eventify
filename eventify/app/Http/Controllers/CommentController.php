<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all(); // Obtener todos los comentarios
        return view('comments.index', compact('comments')); // Retornar la vista con los comentarios
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all(); // Obtener todos los eventos para asociar el comentario
        return view('comments.create', compact('events')); // Retornar la vista del formulario
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id', // Validar que el evento exista
            'user_id' => 'required|exists:users,id', // Validar que el usuario exista
            'content' => 'required|string|max:1000', // Contenido del comentario
            'rating' => 'required|integer|between:1,5', // Puntuación entre 1 y 5
        ]);

        Comment::create($request->all()); // Crear el comentario con los datos del formulario

        return redirect()->route('comments.index')->with('success', 'Comment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::findOrFail($id); // Buscar el comentario o mostrar 404
        return view('comments.show', compact('comment')); // Retornar la vista con el comentario
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id); // Buscar el comentario o mostrar 404
        $events = Event::all(); // Obtener todos los eventos para asociar el comentario
        return view('comments.edit', compact('comment', 'events')); // Retornar la vista del formulario
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id', // Validar que el evento exista
            'user_id' => 'required|exists:users,id', // Validar que el usuario exista
            'content' => 'required|string|max:1000', // Contenido del comentario
            'rating' => 'required|integer|between:1,5', // Puntuación entre 1 y 5
        ]);

        $comment = Comment::findOrFail($id); // Buscar el comentario o mostrar 404
        $comment->update($request->all()); // Actualizar el comentario

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id); // Buscar el comentario o mostrar 404
        $comment->delete(); // Eliminar el comentario

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    ///Listar todas las reseñas con los datos de su película o serie.
    public function index()
    {
        $reviews = Rating::with(['movie', 'serie'])->latest()->get();
        return response()->json($reviews, 200);
    }

    ///Guardar una nueva reseña/calificación.
    public function store(Request $request)
    {
        // 1. Validación de los campos según la migración
        $validated = $request->validate([
            'id_movie'     => 'nullable|required_without:id_serie|exists:movies,id',
            'id_serie'     => 'nullable|required_without:id_movie|exists:series,id',
            'calificacion' => 'required|integer|min:1|max:5',
            'Reseña'       => 'required|string|min:5',
        ]);

        // 2. Crear el registro en la tabla ratings
        $review = Rating::create([
            'id_movie'     => $validated['id_movie'] ?? null,
            'id_serie'     => $validated['id_serie'] ?? null,
            'calificacion' => $validated['calificacion'],
            'Reseña'       => $validated['Reseña'],
        ]);

        return response()->json([
            'message' => 'Reseña guardada con éxito',
            'data'    => $review
        ], 201);
    }

    /// Mostrar una reseña específica por su ID.

    public function show($id)
    {
        $review = Rating::with(['movie', 'serie'])->findOrFail($id);
        return response()->json($review, 200);
    }

    /// Actualizar una reseña existente.
    public function update(Request $request, $id)
    {
        $review = Rating::findOrFail($id);

        $validated = $request->validate([
            'calificacion' => 'sometimes|required|integer|min:1|max:5',
            'Reseña'       => 'sometimes|required|string|min:5',
        ]);

        $review->update($validated);

        return response()->json([
            'message' => 'Reseña actualizada correctamente',
            'data'    => $review
        ], 200);
    }

    /// Eliminar una reseña.
    public function destroy($id)
    {
        $review = Rating::findOrFail($id);
        $review->delete();

        return response()->json([
            'message' => 'Reseña eliminada correctamente'
        ], 200);
    }
}
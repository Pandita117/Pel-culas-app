<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use App\Models\Serie;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        // Relaciones cargadas para la tabla + catálogos para el modal de creación
        $reviews = Review::with(['movie', 'serie'])->latest()->get();
        $movies = Movie::orderBy('titulo')->get();
        $series = Serie::orderBy('titulo')->get();

        return view('review', compact('reviews', 'movies', 'series'));
    }

    public function create()
    {
        $movies = Movie::orderBy('titulo')->get();
        $series = Serie::orderBy('titulo')->get();

        return view('review.create', compact('movies', 'series'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_movie'     => 'nullable|required_without:id_serie|prohibits:id_serie|exists:movies,id',
            'id_serie'     => 'nullable|required_without:id_movie|prohibits:id_movie|exists:series,id',
            'calificacion' => 'required|integer|min:1|max:100',
            'resena'       => 'required|string|min:3',
        ]);

        Review::create([
            'id_movie'     => $request->id_movie,
            'id_serie'     => $request->id_serie,
            'calificacion' => $request->calificacion,
            'resena'       => $request->resena,
        ]);

        return redirect()->route('reviews.index');
    }

    public function show(string $id)
    {
        $review = Review::with(['movie', 'serie'])->findOrFail($id);
        return view('review.show', compact('review'));
    }

    public function edit(string $id)
    {
        $review = Review::with(['movie', 'serie'])->findOrFail($id);
        return view('review.edit', compact('review'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:100',
            'resena'       => 'required|string|min:3',
        ]);

        Review::findOrFail($id)->update([
            'calificacion' => $request->calificacion,
            'resena'       => $request->resena,
        ]);

        return redirect()->route('reviews.index');
    }

    public function destroy(string $id)
    {
        Review::findOrFail($id)->delete();
        return redirect()->route('reviews.index');
    }
}
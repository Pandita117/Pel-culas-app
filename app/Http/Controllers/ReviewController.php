<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['movie', 'serie'])->latest()->get();
        return view('review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('review.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_movie'     => 'nullable|required_without:id_serie|exists:movies,id',
            'id_serie'     => 'nullable|required_without:id_movie|exists:series,id',
            'calificacion' => 'required|integer|min:1|max:100',
            'Reseña'       => 'required|string|min:3',
        ]);

        Review::create([
            'id_movie'     => $request->id_movie,
            'id_serie'     => $request->id_serie,
            'calificacion' => $request->calificacion,
            'Reseña'       => $request->Reseña,
        ]);

        return redirect()->route('reviews.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::with(['movie', 'serie'])->findOrFail($id);
        return view('review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::findOrFail($id);
        return view('review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'Reseña'       => 'required|string|min:3',
        ]);

        Review::findOrFail($id)->update([
            'calificacion' => $request->calificacion,
            'Reseña'       => $request->Reseña,
        ]);

        return redirect()->route('reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Review::findOrFail($id)->delete();

        return redirect()->route('reviews.index');
    }
}
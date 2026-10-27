<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Director;
use App\Models\Gender;
use App\Models\Clasification;
use App\Models\Productor;
use App\Models\Actor;
use App\Models\Platform;
use App\Models\Award;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
{
    $movies = Movie::all();
    $directors = Director::all();
    $generos = Gender::all();
    $clasificaciones = Clasification::all();
    $productoras = Productor::all();
    $actors = Actor::all();
    $platforms = Platform::all();
    $awards = Award::all();

    return view('movie', compact(
        'movies', 
        'directors', 
        'generos', 
        'clasificaciones', 
        'productoras', 
        'actors', 
        'platforms', 
        'awards'
    ));
}

    public function create()
    {
        $directors = Director::all();
        $genders = Gender::all();
        $clasifications = Clasification::all();
        $productors = Productor::all();
        $actors = Actor::all();
        $platforms = Platform::all();
        $awards = Award::all();

        return view('movies.create', compact('directors', 'genders', 'clasifications', 'productors', 'actors', 'platforms', 'awards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'           => 'required|string|max:255',
            'id_director'      => 'nullable|exists:directors,id',
            'id_genero'        => 'nullable|exists:genders,id',
            'id_clasificacion' => 'nullable|exists:clasifications,id',
            'id_productora'    => 'nullable|exists:productors,id',
            'cantidad_premios' => 'required|integer|min:0',
            'fecha_lanzamiento'=> 'required|date',
            'duracion'         => 'required|integer|min:1',
            'actors'           => 'nullable|array',
            'actors.*'         => 'exists:actors,id',
            'platforms'        => 'nullable|array',
            'platforms.*'      => 'exists:platforms,id',
            'awards'           => 'nullable|array',
            'awards.*'         => 'exists:awards,id',
        ]);

        $movie = Movie::create([
            'titulo'           => $request->titulo,
            'id_director'      => $request->id_director,
            'id_genero'        => $request->id_genero,
            'id_clasificacion' => $request->id_clasificacion,
            'id_productora'    => $request->id_productora,
            'cantidad_premios' => $request->cantidad_premios,
            'fecha_lanzamiento'=> $request->fecha_lanzamiento,
            'duracion'         => $request->duracion,
        ]);

        if ($request->has('actors')) {
            $movie->actors()->sync($request->actors);
        }
        if ($request->has('platforms')) {
            $movie->platforms()->sync($request->platforms);
        }
        if ($request->has('awards')) {
            $movie->awards()->sync($request->awards);
        }

        return redirect()->route('movies.index');
    }

    public function show(string $id)
    {
        $movie = Movie::with(['director', 'gender', 'clasification', 'productor', 'actors', 'platforms', 'awards', 'reviews'])->findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        $directors = Director::all();
        $genders = Gender::all();
        $clasifications = Clasification::all();
        $productors = Productor::all();
        $actors = Actor::all();
        $platforms = Platform::all();
        $awards = Award::all();

        return view('movies.edit', compact('movie', 'directors', 'genders', 'clasifications', 'productors', 'actors', 'platforms', 'awards'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo'           => 'required|string|max:255',
            'id_director'      => 'nullable|exists:directors,id',
            'id_genero'        => 'nullable|exists:genders,id',
            'id_clasificacion' => 'nullable|exists:clasifications,id',
            'id_productora'    => 'nullable|exists:productors,id',
            'cantidad_premios' => 'required|integer|min:0',
            'fecha_lanzamiento'=> 'required|date',
            'duracion'         => 'required|integer|min:1',
            'actors'           => 'nullable|array',
            'actors.*'         => 'exists:actors,id',
            'platforms'        => 'nullable|array',
            'platforms.*'      => 'exists:platforms,id',
            'awards'           => 'nullable|array',
            'awards.*'         => 'exists:awards,id',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update([
            'titulo'           => $request->titulo,
            'id_director'      => $request->id_director,
            'id_genero'        => $request->id_genero,
            'id_clasificacion' => $request->id_clasificacion,
            'id_productora'    => $request->id_productora,
            'cantidad_premios' => $request->cantidad_premios,
            'fecha_lanzamiento'=> $request->fecha_lanzamiento,
            'duracion'         => $request->duracion,
        ]);

        $movie->actors()->sync($request->input('actors', []));
        $movie->platforms()->sync($request->input('platforms', []));
        $movie->awards()->sync($request->input('awards', []));

        return redirect()->route('movies.index');
    }

    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index');
    }
}
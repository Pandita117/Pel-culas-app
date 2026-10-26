<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Director;
use App\Models\Gender;
use App\Models\Clasification;
use App\Models\Productor;
use App\Models\Actor;
use App\Models\Platform;
use App\Models\Award;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::with(['director', 'gender', 'clasification', 'productor'])->get();
        return view('series.index', compact('series'));
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

        return view('series.create', compact('directors', 'genders', 'clasifications', 'productors', 'actors', 'platforms', 'awards'));
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
            'cant_episodios'   => 'required|integer|min:1',
            'actors'           => 'nullable|array',
            'actors.*'         => 'exists:actors,id',
            'platforms'        => 'nullable|array',
            'platforms.*'      => 'exists:platforms,id',
            'awards'           => 'nullable|array',
            'awards.*'         => 'exists:awards,id',
        ]);

        $serie = Serie::create([
            'titulo'           => $request->titulo,
            'id_director'      => $request->id_director,
            'id_genero'        => $request->id_genero,
            'id_clasificacion' => $request->id_clasificacion,
            'id_productora'    => $request->id_productora,
            'cantidad_premios' => $request->cantidad_premios,
            'fecha_lanzamiento'=> $request->fecha_lanzamiento,
            'cant_episodios'   => $request->cant_episodios,
        ]);

        if ($request->has('actors')) {
            $serie->actors()->sync($request->actors);
        }
        if ($request->has('platforms')) {
            $serie->platforms()->sync($request->platforms);
        }
        if ($request->has('awards')) {
            $serie->awards()->sync($request->awards);
        }

        return redirect()->route('series.index');
    }

    public function show(string $id)
    {
        $serie = Serie::with(['director', 'gender', 'clasification', 'productor', 'actors', 'platforms', 'awards', 'reviews'])->findOrFail($id);
        return view('series.show', compact('serie'));
    }

    public function edit(string $id)
    {
        $serie = Serie::findOrFail($id);
        $directors = Director::all();
        $genders = Gender::all();
        $clasifications = Clasification::all();
        $productors = Productor::all();
        $actors = Actor::all();
        $platforms = Platform::all();
        $awards = Award::all();

        return view('series.edit', compact('serie', 'directors', 'genders', 'clasifications', 'productors', 'actors', 'platforms', 'awards'));
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
            'cant_episodios'   => 'required|integer|min:1',
            'actors'           => 'nullable|array',
            'actors.*'         => 'exists:actors,id',
            'platforms'        => 'nullable|array',
            'platforms.*'      => 'exists:platforms,id',
            'awards'           => 'nullable|array',
            'awards.*'         => 'exists:awards,id',
        ]);

        $serie = Serie::findOrFail($id);
        $serie->update([
            'titulo'           => $request->titulo,
            'id_director'      => $request->id_director,
            'id_genero'        => $request->id_genero,
            'id_clasificacion' => $request->id_clasificacion,
            'id_productora'    => $request->id_productora,
            'cantidad_premios' => $request->cantidad_premios,
            'fecha_lanzamiento'=> $request->fecha_lanzamiento,
            'cant_episodios'   => $request->cant_episodios,
        ]);

        $serie->actors()->sync($request->input('actors', []));
        $serie->platforms()->sync($request->input('platforms', []));
        $serie->awards()->sync($request->input('awards', []));

        return redirect()->route('series.index');
    }

    public function destroy(string $id)
    {
        $serie = Serie::findOrFail($id);
        $serie->delete();

        return redirect()->route('series.index');
    }
}
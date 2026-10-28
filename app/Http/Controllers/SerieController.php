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
        $series = Serie::with(['director', 'gender', 'clasification', 'productor', 'actors', 'platforms', 'awards'])->get();

        $directors = Director::all();
        $generos = Gender::all();
        $clasificaciones = Clasification::all();
        $productoras = Productor::all();
        $actors = Actor::all();
        $platforms = Platform::all();
        $awards = Award::all();

        return view('serie', compact(
            'series', 'directors', 'generos', 'clasificaciones',
            'productoras', 'actors', 'platforms', 'awards'
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

        return view('series.create', compact('directors', 'genders', 'clasifications', 'productors', 'actors', 'platforms', 'awards'));
    }

    public function store(Request $request)
    {
        $cantAwards = count($request->input('awards', []));

        $request->validate([
            'titulo'           => 'required|string|max:255',
            'id_director'      => 'required|exists:directors,id',
            'id_genero'        => 'required|exists:genders,id',
            'id_clasificacion' => 'required|exists:clasifications,id',
            'id_productora'    => 'required|exists:productors,id',
            'cantidad_premios' => "required|integer|min:{$cantAwards}",
            'fecha_lanzamiento'=> 'required|date',
            'cant_episodios'   => 'required|integer|min:1',
            // Al menos 1 actor es OBLIGATORIO
            'actors'           => 'required|array|min:1',
            'actors.*'         => 'exists:actors,id',
            'platforms'        => 'nullable|array',
            'platforms.*'      => 'exists:platforms,id',
            'awards'           => 'nullable|array',
            'awards.*'         => 'exists:awards,id',
        ], [
            'actors.required'     => 'Debes seleccionar al menos un actor para guardar la serie.',
            'actors.min'          => 'Debes seleccionar al menos un actor.',
            'cantidad_premios.min'=> "La cantidad de premios no puede ser menor a los {$cantAwards} tipos de premios seleccionados.",
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

        $serie->actors()->sync($request->actors);
        $serie->platforms()->sync($request->input('platforms', []));
        $serie->awards()->sync($request->input('awards', []));

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
        $cantAwards = count($request->input('awards', []));

        $request->validate([
            'titulo'           => 'required|string|max:255',
            'id_director'      => 'required|exists:directors,id',
            'id_genero'        => 'required|exists:genders,id',
            'id_clasificacion' => 'required|exists:clasifications,id',
            'id_productora'    => 'required|exists:productors,id',
            'cantidad_premios' => "required|integer|min:{$cantAwards}",
            'fecha_lanzamiento'=> 'required|date',
            'cant_episodios'   => 'required|integer|min:1',
            // Al menos 1 actor es OBLIGATORIO
            'actors'           => 'required|array|min:1',
            'actors.*'         => 'exists:actors,id',
            'platforms'        => 'nullable|array',
            'platforms.*'      => 'exists:platforms,id',
            'awards'           => 'nullable|array',
            'awards.*'         => 'exists:awards,id',
        ], [
            'actors.required'     => 'Debes seleccionar al menos un actor para actualizar la serie.',
            'actors.min'          => 'Debes seleccionar al menos un actor.',
            'cantidad_premios.min'=> "La cantidad de premios no puede ser menor a los {$cantAwards} tipos de premios seleccionados.",
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

        $serie->actors()->sync($request->actors);
        $serie->platforms()->sync($request->input('platforms', []));
        $serie->awards()->sync($request->input('awards', []));

        return redirect()->route('series.index');
    }

    public function destroy(string $id)
    {
        $serie = Serie::findOrFail($id);
        $serie->actors()->detach();
        $serie->platforms()->detach();
        $serie->awards()->detach();
        $serie->delete();

        return redirect()->route('series.index');
    }
}
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
        $movies = Movie::with(['director', 'gender', 'clasification', 'productor', 'actors', 'platforms', 'awards'])->get();
        
        $directors = Director::all();
        $generos = Gender::all();
        $clasificaciones = Clasification::all();
        $productoras = Productor::all();
        $actors = Actor::all();
        $platforms = Platform::all();
        $awards = Award::all();

        return view('movie', compact(
            'movies', 'directors', 'generos', 'clasificaciones', 
            'productoras', 'actors', 'platforms', 'awards'
        ));
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
            'duracion'         => 'required|integer|min:1',
            'actors'           => 'required|array|min:1',
            'actors.*'         => 'exists:actors,id',
            'platforms'        => 'nullable|array',
            'platforms.*'      => 'exists:platforms,id',
            'awards'           => 'nullable|array',
            'awards.*'         => 'exists:awards,id',
        ], [
            'actors.required'     => 'Debes seleccionar al menos un actor para guardar la película.',
            'actors.min'          => 'Debes seleccionar al menos un actor.',
            'cantidad_premios.min'=> "La cantidad de premios no puede ser menor a los {$cantAwards} tipos de premios seleccionados.",
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

        // Sincronizar relaciones N:M
        $movie->actors()->sync($request->actors);
        $movie->platforms()->sync($request->input('platforms', []));
        $movie->awards()->sync($request->input('awards', []));

        return redirect()->route('movies.index');
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
            'duracion'         => 'required|integer|min:1',
            // Al menos 1 actor es OBLIGATORIO en edición
            'actors'           => 'required|array|min:1',
            'actors.*'         => 'exists:actors,id',
            'platforms'        => 'nullable|array',
            'platforms.*'      => 'exists:platforms,id',
            'awards'           => 'nullable|array',
            'awards.*'         => 'exists:awards,id',
        ], [
            'actors.required'     => 'Debes seleccionar al menos un actor para actualizar la película.',
            'actors.min'          => 'Debes seleccionar al menos un actor.',
            'cantidad_premios.min'=> "La cantidad de premios no puede ser menor a los {$cantAwards} tipos de premios seleccionados.",
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

        $movie->actors()->sync($request->actors);
        $movie->platforms()->sync($request->input('platforms', []));
        $movie->awards()->sync($request->input('awards', []));

        return redirect()->route('movies.index');
    }

    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->actors()->detach();
        $movie->platforms()->detach();
        $movie->awards()->detach();
        $movie->delete();

        return redirect()->route('movies.index');
    }
}
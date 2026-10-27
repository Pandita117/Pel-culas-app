<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Nationality;
use App\Models\Award;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index()
    {
        $directors = Director::with(['nationality', 'award'])->get();

        $nationalities = Nationality::all();
        $awards = Award::all();
        return view('director', compact('directors','nationalities','awards'));
    }

    public function create()
    {
        $nationalities = Nationality::all();
        $awards = Award::all();
        return view('directors.create', compact('nationalities', 'awards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'          => 'required|string|max:255',
            'apellido'        => 'required|string|max:255',
            'fecha_naci'      => 'required|date',
            'id_nacionalidad' => 'required|exists:nationalities,id',
            'id_premios'      => 'nullable|exists:awards,id',
        ]);

        Director::create([
            'nombre'          => $request->nombre,
            'apellido'        => $request->apellido,
            'fecha_naci'      => $request->fecha_naci,
            'id_nacionalidad' => $request->id_nacionalidad,
            'id_premios'      => $request->id_premios,
        ]);

        return redirect()->route('directors.index');
    }

    public function show(string $id)
    {
        $director = Director::with(['nationality', 'award'])->findOrFail($id);
        return view('directors.show', compact('director'));
    }

    public function edit(string $id)
    {
        $director = Director::findOrFail($id);
        $nationalities = Nationality::all();
        $awards = Award::all();
        return view('directors.edit', compact('director', 'nationalities', 'awards'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre'          => 'required|string|max:255',
            'apellido'        => 'required|string|max:255',
            'fecha_naci'      => 'required|date',
            'id_nacionalidad' => 'required|exists:nationalities,id',
            'id_premios'      => 'nullable|exists:awards,id',
        ]);

        Director::findOrFail($id)->update([
            'nombre'          => $request->nombre,
            'apellido'        => $request->apellido,
            'fecha_naci'      => $request->fecha_naci,
            'id_nacionalidad' => $request->id_nacionalidad,
            'id_premios'      => $request->id_premios,
        ]);

        return redirect()->route('directors.index');
    }

    public function destroy(string $id)
    {
        Director::findOrFail($id)->delete();
        return redirect()->route('directors.index');
    }
}
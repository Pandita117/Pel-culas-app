<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function index()
    {
        $generos = Gender::all();
        return view('genero.index', compact('generos'));
    }

    public function create()
    {
        return view('genero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'genero'      => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Gender::create([
            'genero'      => $request->genero,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('generos.index');
    }

    public function show(string $id)
    {
        $genero = Gender::findOrFail($id);
        return view('genero.show', compact('genero'));
    }

    public function edit(string $id)
    {
        $genero = Gender::findOrFail($id);
        return view('genero.edit', compact('genero'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'genero'      => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Gender::findOrFail($id)->update([
            'genero'      => $request->genero,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('generos.index');
    }

    public function destroy(string $id)
    {
        Gender::findOrFail($id)->delete();
        return redirect()->route('generos.index');
    }
}
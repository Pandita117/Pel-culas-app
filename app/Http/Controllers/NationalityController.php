<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index()
    {
        $nacionalidades = Nationality::all();
        return view('nationality', compact('nacionalidades'));
    }

    public function create()
    {
        return view('nacionalidad.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'idioma'     => 'required|string|max:255',
            'pais'       => 'required|string|max:255|unique:nationalities,pais',
            'continente' => 'required|string|max:255',
        ]);

        Nationality::create([
            'idioma'     => $request->idioma,
            'pais'       => $request->pais,
            'continente' => $request->continente,
        ]);

        return redirect()->route('nacionalidades.index');
    }

    public function show(string $id)
    {
        $nacionalidad = Nationality::findOrFail($id);
        return view('nacionalidad.show', compact('nacionalidad'));
    }

    public function edit(string $id)
    {
        $nacionalidad = Nationality::findOrFail($id);
        return view('nacionalidad.edit', compact('nacionalidad'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'idioma'     => 'required|string|max:255',
            'pais'       => 'required|string|max:255|unique:nationalities,pais,' .$id,
            'continente' => 'required|string|max:255',
        ]);

        Nationality::findOrFail($id)->update([
            'idioma'     => $request->idioma,
            'pais'       => $request->pais,
            'continente' => $request->continente,
        ]);

        return redirect()->route('nacionalidades.index');
    }

    public function destroy(string $id)
    {
        Nationality::findOrFail($id)->delete();
        return redirect()->route('nacionalidades.index');
    }
}
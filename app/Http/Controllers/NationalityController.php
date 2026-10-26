<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nacionalidades = Nationality::all();
        return view('nacionalidad.index', compact('nacionalidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nacionalidad.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idioma'     => 'required|string|max:255',
            'Pais'       => 'required|string|max:255',
            'continente' => 'required|string|max:255',
        ]);

        Nationality::create([
            'idioma'     => $request->idioma,
            'Pais'       => $request->Pais,
            'continente' => $request->continente,
        ]);

        return redirect()->route('nacionalidades.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nacionalidad = Nationality::findOrFail($id);
        return view('nacionalidad.show', compact('nacionalidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nacionalidad = Nationality::findOrFail($id);
        return view('nacionalidad.edit', compact('nacionalidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idioma'     => 'required|string|max:255',
            'Pais'       => 'required|string|max:255',
            'continente' => 'required|string|max:255',
        ]);

        Nationality::findOrFail($id)->update([
            'idioma'     => $request->idioma,
            'Pais'       => $request->Pais,
            'continente' => $request->continente,
        ]);

        return redirect()->route('nacionalidades.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Nationality::findOrFail($id)->delete();

        return redirect()->route('nacionalidades.index');
    }
}
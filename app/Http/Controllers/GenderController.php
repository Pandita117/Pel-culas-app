<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generos = Gender::all();
        return view('genero.index', compact('generos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'genero'      => 'required|string|max:255',
            'Descripcion' => 'required|string',
        ]);

        Gender::create([
            'genero'      => $request->genero,
            'Descripcion' => $request->Descripcion,
        ]);

        return redirect()->route('generos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genero = Gender::findOrFail($id);
        return view('genero.show', compact('genero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genero = Gender::findOrFail($id);
        return view('genero.edit', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'genero'      => 'required|string|max:255',
            'Descripcion' => 'required|string',
        ]);

        Gender::findOrFail($id)->update([
            'genero'      => $request->genero,
            'Descripcion' => $request->Descripcion,
        ]);

        return redirect()->route('generos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gender::findOrFail($id)->delete();

        return redirect()->route('generos.index');
    }
}
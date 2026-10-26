<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plataformas = Platform::all();
        return view('plataforma.index', compact('plataformas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plataforma.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'costo'  => 'required|integer|min:0',
        ]);

        Platform::create([
            'nombre' => $request->nombre,
            'costo'  => $request->costo,
        ]);

        return redirect()->route('plataformas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plataforma = Platform::findOrFail($id);
        return view('plataforma.show', compact('plataforma'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plataforma = Platform::findOrFail($id);
        return view('plataforma.edit', compact('plataforma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'costo'  => 'required|integer|min:0',
        ]);

        Platform::findOrFail($id)->update([
            'nombre' => $request->nombre,
            'costo'  => $request->costo,
        ]);

        return redirect()->route('plataformas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Platform::findOrFail($id)->delete();

        return redirect()->route('plataformas.index');
    }
}
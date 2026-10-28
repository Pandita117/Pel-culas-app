<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index()
    {
        $plataformas = Platform::all();
        return view('platform', compact('plataformas'));
    }

    public function create()
    {
        return view('plataforma.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:platforms,nombre',
            'costo'  => 'required|numeric|min:0',
        ]);

        Platform::create([
            'nombre' => $request->nombre,
            'costo'  => $request->costo,
        ]);

        return redirect()->route('plataformas.index');
    }

    public function show(string $id)
    {
        $plataforma = Platform::findOrFail($id);
        return view('plataforma.show', compact('plataforma'));
    }

    public function edit(string $id)
    {
        $plataforma = Platform::findOrFail($id);
        return view('plataforma.edit', compact('plataforma'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:platforms,nombre,' . $id,
            'costo'  => 'required|numeric|min:0',
        ]);

        Platform::findOrFail($id)->update([
            'nombre' => $request->nombre,
            'costo'  => $request->costo,
        ]);

        return redirect()->route('plataformas.index');
    }

    public function destroy(string $id)
    {
        Platform::findOrFail($id)->delete();
        return redirect()->route('plataformas.index');
    }
}
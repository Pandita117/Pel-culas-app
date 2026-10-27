<?php

namespace App\Http\Controllers;

use App\Models\Clasification;
use Illuminate\Http\Request;

class ClasificationController extends Controller
{
    public function index()
    {
        $clasificaciones = Clasification::all();
        return view('clasificacion', compact('clasificaciones'));
    }

    public function create()
    {
        return view('clasificacion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'clasificacion' => 'required|string|max:255',
            'rango'         => 'required|in:Todos,12-15,16-17,+18',
            'descripcion'   => 'required|string',
        ]);

        Clasification::create([
            'clasificacion' => $request->clasificacion,
            'rango'         => $request->rango,
            'descripcion'   => $request->descripcion,
        ]);

        return redirect()->route('clasificaciones.index');
    }

    public function show(string $id)
    {
        $clasificacion = Clasification::findOrFail($id);
        return view('clasificacion.show', compact('clasificacion'));
    }

    public function edit(string $id)
    {
        $clasificacion = Clasification::findOrFail($id);
        return view('clasificacion.edit', compact('clasificacion'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'clasificacion' => 'required|string|max:255',
            'rango'         => 'required|in:Todos,12-15,16-17,+18',
            'descripcion'   => 'required|string',
        ]);

        Clasification::findOrFail($id)->update([
            'clasificacion' => $request->clasificacion,
            'rango'         => $request->rango,
            'descripcion'   => $request->descripcion,
        ]);

        return redirect()->route('clasificaciones.index');
    }

    public function destroy(string $id)
    {
        Clasification::findOrFail($id)->delete();
        return redirect()->route('clasificaciones.index');
    }
}
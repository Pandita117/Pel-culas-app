<?php

namespace App\Http\Controllers;

use App\Models\Clasification;
use Illuminate\Http\Request;

class ClasificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clasificaciones = Clasification::all();
        return view('clasificacion.index', compact('clasificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clasificacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'clasficiacion' => 'required|string|max:255',
            'rango'         => 'required|in:Todos,12-15,16-17,+18',
            'Descripcion'   => 'required|string',
        ]);

        Clasification::create([
            'clasficiacion' => $request->clasficiacion,
            'rango'         => $request->rango,
            'Descripcion'   => $request->Descripcion,
        ]);

        return redirect()->route('clasificaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clasificacion = Clasification::findOrFail($id);
        return view('clasificacion.show', compact('clasificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $clasificacion = Clasification::findOrFail($id);
        return view('clasificacion.edit', compact('clasificacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'clasficiacion' => 'required|string|max:255',
            'rango'         => 'required|in:Todos,12-15,16-17,+18',
            'Descripcion'   => 'required|string',
        ]);

        Clasification::findOrFail($id)->update([
            'clasficiacion' => $request->clasficiacion,
            'rango'         => $request->rango,
            'Descripcion'   => $request->Descripcion,
        ]);

        return redirect()->route('clasificaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Clasification::findOrFail($id)->delete();

        return redirect()->route('clasificaciones.index');
    }
}
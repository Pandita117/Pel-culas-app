<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::all();
        return view('awards.index', compact('awards'));
    }

    public function create()
    {
        return view('awards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_premio'  => 'required|string|max:255',
            'fecha_creacion' => 'required|date',
        ]);

        Award::create([
            'nombre_premio'  => $request->nombre_premio,
            'fecha_creacion' => $request->fecha_creacion,
        ]);

        return redirect()->route('awards.index');
    }

    public function show(string $id)
    {
        $award = Award::findOrFail($id);
        return view('awards.show', compact('award'));
    }

    public function edit(string $id)
    {
        $award = Award::findOrFail($id);
        return view('awards.edit', compact('award'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre_premio'  => 'required|string|max:255',
            'fecha_creacion' => 'required|date',
        ]);

        Award::findOrFail($id)->update([
            'nombre_premio'  => $request->nombre_premio,
            'fecha_creacion' => $request->fecha_creacion,
        ]);

        return redirect()->route('awards.index');
    }

    public function destroy(string $id)
    {
        Award::findOrFail($id)->delete();
        return redirect()->route('awards.index');
    }
}
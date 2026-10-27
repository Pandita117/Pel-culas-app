<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Nationality;
use App\Models\Award;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::with(['nationality', 'award'])->get();

        $nationalities = Nationality::all();
        $awards = Award::all();
        return view('actor', compact('actors','nationalities','awards'));
    }

    public function create()
    {
        $nationalities = Nationality::all();
        $awards = Award::all();
        return view('actors.create', compact('nationalities', 'awards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_act'      => 'required|string|max:255',
            'apellido_act'    => 'required|string|max:255',
            'f_nac'           => 'required|date',
            'id_nacionalidad' => 'required|exists:nationalities,id',
            'id_premios'      => 'nullable|exists:awards,id',
        ]);

        Actor::create([
            'nombre_act'      => $request->nombre_act,
            'apellido_act'    => $request->apellido_act,
            'f_nac'           => $request->f_nac,
            'id_nacionalidad' => $request->id_nacionalidad,
            'id_premios'      => $request->id_premios,
        ]);

        return redirect()->route('actors.index');
    }

    public function show(string $id)
    {
        $actor = Actor::with(['nationality', 'award'])->findOrFail($id);
        return view('actors.show', compact('actor'));
    }

    public function edit(string $id)
    {
        $actor = Actor::findOrFail($id);
        $nationalities = Nationality::all();
        $awards = Award::all();
        return view('actors.edit', compact('actor', 'nationalities', 'awards'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre_act'      => 'required|string|max:255',
            'apellido_act'    => 'required|string|max:255',
            'f_nac'           => 'required|date',
            'id_nacionalidad' => 'required|exists:nationalities,id',
            'id_premios'      => 'nullable|exists:awards,id',
        ]);

        Actor::findOrFail($id)->update([
            'nombre_act'      => $request->nombre_act,
            'apellido_act'    => $request->apellido_act,
            'f_nac'           => $request->f_nac,
            'id_nacionalidad' => $request->id_nacionalidad,
            'id_premios'      => $request->id_premios,
        ]);

        return redirect()->route('actors.index');
    }

    public function destroy(string $id)
    {
        Actor::findOrFail($id)->delete();
        return redirect()->route('actors.index');
    }
}
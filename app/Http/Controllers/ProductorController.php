<?php

namespace App\Http\Controllers;

use App\Models\Productor;
use Illuminate\Http\Request;

class ProductorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productoras = Productor::all();
        return view('productor', compact('productoras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productora.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_productora' => 'required|string|max:255',
        ]);

        Productor::create([
            'nombre_productora' => $request->nombre_productora,
        ]);

        return redirect()->route('productoras.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productora = Productor::findOrFail($id);
        return view('productora.show', compact('productora'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productora = Productor::findOrFail($id);
        return view('productora.edit', compact('productora'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre_productora' => 'required|string|max:255',
        ]);

        Productor::findOrFail($id)->update([
            'nombre_productora' => $request->nombre_productora,
        ]);

        return redirect()->route('productoras.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Productor::findOrFail($id)->delete();

        return redirect()->route('productoras.index');
    }
}
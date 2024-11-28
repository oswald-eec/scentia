<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();

        return view('admin.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validaciones con mensajes personalizados
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:levels,name',
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.unique' => 'Ya existe una categoría con este nombre.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
        ]);

        // Creación de la categoría
        $level = Level::create($validatedData);

        // Redirección con un mensaje de éxito
        return redirect()->route('admin.levels.index')->with('success', 'El nivel ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        return view('admin.levels.show', compact('level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        return view('admin.levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        // Validaciones con mensajes personalizados
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:levels,name,' . $level->id,
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.unique' => 'Ya existe una categoría con este nombre.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
        ]);

        // Actualización de la categoría
        $level->update($validatedData);

        // Redirección con un mensaje de éxito
        return redirect()->route('admin.levels.index')->with('success', 'El nivel ha sido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('admin.levels.index')->with('success', 'El nivel ha sido eliminado exitosamente.');
    }
}

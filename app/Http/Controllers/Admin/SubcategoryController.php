<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')->latest()->paginate(10);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::pluck('name', 'id');
        $selectedCategory = $request->get('category_id'); // para cuando vienes desde categorías
        return view('admin.subcategories.create', compact('categories', 'selectedCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255|unique:subcategories,name',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required'        => 'El campo nombre es obligatorio.',
            'name.unique'          => 'Ya existe una subcategoría con este nombre.',
            'name.max'             => 'El nombre no debe exceder los 255 caracteres.',
            'category_id.required' => 'Debe seleccionar una categoría.',
            'category_id.exists'   => 'La categoría seleccionada no existe.',
        ]);

        Subcategory::create([
            'name'        => ucfirst(trim($validatedData['name'])),
            'slug'        => Str::slug($validatedData['name']),
            'category_id' => $validatedData['category_id'],
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Subcategoría creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subcategories,name,' . $subcategory->id,
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Subcategoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Subcategoría eliminada correctamente.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::latest()->paginate(10);
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string|max:500',
        ]);

        $imagePath = $request->file('image')->store('promotions', 'public');

        Promotion::create([
            'name' => $request->name,
            'image_url' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.promotions.index')->with('success', 'Promoción creada correctamente.');
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
    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($promotion->image);
            $imagePath = $request->file('image')->store('promotions', 'public');
            $promotion->image = $imagePath;
        }

        $promotion->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.promotions.index')->with('success', 'Promoción actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        Storage::disk('public')->delete($promotion->image_url);
        $promotion->delete();

        return redirect()->route('admin.promotions.index')->with('success', 'Promoción eliminada correctamente.');
    }
}

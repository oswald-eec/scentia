<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer cursos')->only('index');
        $this->middleware('can:Crear cursos')->only('create', 'store');
        $this->middleware('can:Editar cursos')->only('edit','update','goals');
        $this->middleware('can:Eliminar cursos')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instructor.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $levels = Level::pluck('name', 'id');
        $prices = Price::pluck('name', 'id');

        return view('instructor.courses.create', compact('categories','levels','prices'));
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
            'title' => 'required|string|max:255|unique:courses,title',
            'slug' => 'required|string|max:255|unique:courses,slug',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'price_id' => 'required|exists:prices,id',
            'file' => 'nullable|image|max:2048', // Valida que la imagen no sea mayor a 2MB
        ]);

        $course = Course::create($request->all());

        if($request->file('file')){
            $url = Storage::put('cursos', $request->file('file'));
            $course->image()->create([
                'url' => $url
            ]);
        }

        return redirect()->route('instructor.courses.edit', $course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('instructor.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

        $this->authorize('dicatated', $course);

        $categories = Category::pluck('name', 'id');
        $levels = Level::pluck('name', 'id');
        $prices = Price::pluck('name', 'id');

        return view('instructor.courses.edit', compact('course', 'categories', 'levels', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        // Validaciones
        $request->validate([
            'title' => 'required|string|max:255|unique:courses,title,' . $course->id,
            'slug' => 'required|string|max:255|unique:courses,slug,' . $course->id,
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'price_id' => 'required|exists:prices,id',
            'file' => 'nullable|image|max:2048', // Valida que la imagen no sea mayor a 2MB
        ]);

        // Actualización del curso
        $course->update($request->only([
            'title', 'slug', 'subtitle', 'description', 'category_id', 'level_id', 'price_id'
        ]));

        // Actualización de la imagen si se carga una nueva
        if ($request->hasFile('file')) {
            // Eliminar la imagen anterior si existe
            if ($course->image) {
                Storage::delete($course->image->url);
                $course->image()->delete();
            }

            // Guardar la nueva imagen
            $url = Storage::put('cursos', $request->file('file'));
            $course->image()->create(['url' => $url]);
        }

        return redirect()->route('instructor.courses.edit', $course)
                        ->with('success', 'Curso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }

    public function goals(Course $course){
        $this->authorize('dicatated', $course);
        return view('instructor.courses.goals', compact('course'));
    }

    public function status(Course $course){
        $course->status =2;
        $course->save();
        return back();
    }
}

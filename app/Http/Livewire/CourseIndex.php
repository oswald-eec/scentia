<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class CourseIndex extends Component
{
    use WithPagination;
    public $category_id = null;
    public $level_id = null;
    public $subcategory_id = null;

    public function updatedCategoryId($value)
    {
        // Cuando cambie la categoría, resetear subcategoría
        $this->subcategory_id = null;
    }

    public function render()
    {
        // Listado de categorías y niveles (para los dropdowns)
        $categories = Category::with('subcategories')->get();
        $levels = Level::all();

        // Subcategorías dependientes de la categoría seleccionada
        $subcategories = $this->category_id
            ? Subcategory::where('category_id', $this->category_id)->get()
            : collect();

        // Construcción de la consulta con filtros dinámicos
        $courses = Course::query()
            ->where('status', 3) // Solo cursos publicados
            ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
            ->when($this->subcategory_id, fn($q) => $q->where('subcategory_id', $this->subcategory_id))
            ->when($this->level_id, fn($q) => $q->where('level_id', $this->level_id))
            ->latest('id')
            ->paginate(8);

        return view('livewire.course-index', compact('courses', 'categories', 'levels', 'subcategories'));
    }

    public function resetFilters(){
        $this->reset(['category_id', 'subcategory_id', 'level_id']);
    }
}

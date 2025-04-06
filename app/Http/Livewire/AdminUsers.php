<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search = '';
    public $role;

    protected $queryString = ['search'];

    public function mount($role)
    {
        $this->role = $role;
    }

    public function render()
    {
        $query = User::query();

        if ($this->role === 'Estudiante') {
            $query->role('Estudiante');
        } elseif ($this->role === 'Instructor') {
            $query->role('Instructor');
        }

        $users = $query->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
              ->orWhere('email', 'like', '%' . $this->search . '%');
        })->with('courses_enrolled')->paginate(10);

        return view('livewire.admin-users', compact('users'));
    }

    public function limpiar_page()
    {
        $this->resetPage();
    }
}

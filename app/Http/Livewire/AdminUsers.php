<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('name', 'LIKE', '%' . $this->search . '%')
                ->paginate(8);
        return view('livewire.admin-users', compact('users'));
    }

    public function limpiar_page(){
        $this->reset('page');
    }
}

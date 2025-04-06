<?php

namespace App\Http\Livewire\Profile;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdatePreferencesForm extends Component
{
    public $selectedCategories = [];

    public function mount()
    {
        $this->selectedCategories = Auth::user()->preferences->pluck('id')->toArray();
    }

    public function updatePreferences()
    {
        Auth::user()->preferences()->sync($this->selectedCategories);
        session()->flash('success', 'Preferencias actualizadas correctamente.');
    }

    public function render()
    {
        return view('livewire.profile.update-preferences-form', [
            'categories' => Category::all(),
        ]);
    }
}

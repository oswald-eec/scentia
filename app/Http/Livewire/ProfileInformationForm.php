<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ProfileInformationForm extends Component
{
    public $state = [];

    public function mount()
    {
        $this->state = array_merge(Auth::user()->toArray(), [
            'profile' => Auth::user()->profile ? Auth::user()->profile->toArray() : [],
        ]);
    }

    public function updateProfileInformation()
    {
        $user = Auth::user();

        // Validar datos
        Validator::make($this->state, [
            'name' => 'required|string|max:64',
            'email' => 'required|string|email|max:128',
            'profile.title' => 'nullable|string|max:255',
            'profile.biography' => 'nullable|string|max:500',
            'profile.website' => 'nullable|url|max:255',
            'profile.facebook' => 'nullable|url|max:255',
            'profile.youtube' => 'nullable|url|max:255',
        ])->validate();

        // Actualizar usuario
        $user->update([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
        ]);

        // Actualizar o crear perfil
        $user->profile()->updateOrCreate(
            [],
            $this->state['profile']
        );

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.profile-information-form');
    }
}

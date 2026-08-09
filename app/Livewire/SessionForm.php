<?php

namespace App\Livewire;

use Livewire\Component;

class SessionForm extends Component
{
    public $firstName = '';
    public $secondName = '';

    public function submitForm()
    {
        $this->validate([
            'firstName' => 'required|string|min:2|max:50',
            'secondName' => 'required|string|min:2|max:50',
        ]);

        session([
            'first_name' => $this->firstName,
            'second_name' => $this->secondName,
        ]);

        // Tells your dashboard listener to flag 'session' tab as active
        $this->dispatch('tab-changed', tab: 'session');
    }

    public function render()
    {
        return view('livewire.session-form');
    }
}

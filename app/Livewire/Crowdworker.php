<?php

namespace App\Livewire;

use Livewire\Component;

class Crowdworker extends Component
{
    public $name;
    public $contact;
    public $email;
    public $street;
    public $crowdworkers = [];

    public function mount()
    {
        // Initialize with sample data
        $this->crowdworkers = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'contact' => '0711223344',
                'email' => 'john@gmail.com',
                'street' => 'Moi Avenue'
            ],
            [
                'id' => 2,
                'name' => 'Jane Wanjiku',
                'contact' => '0722334455',
                'email' => 'jane@gmail.com',
                'street' => 'Kenyatta Avenue'
            ],
            [
                'id' => 3,
                'name' => 'Peter Otieno',
                'contact' => '0733445566',
                'email' => 'peter@gmail.com',
                'street' => 'Tom Mboya Street'
            ],
            [
                'id' => 4,
                'name' => 'Mary Akinyi X',
                'contact' => '0744556677',
                'email' => 'mary@gmail.com',
                'street' => 'Ngong Road'
            ]
        ];
    }

    public function saveCrowdworker()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email',
            'street' => 'required|string|max:255',
        ]);

        // Add new crowdworker
        $this->crowdworkers[] = [
            'id' => count($this->crowdworkers) + 1,
            'name' => $this->name,
            'contact' => $this->contact,
            'email' => $this->email,
            'street' => $this->street,
        ];

        // Reset form
        $this->reset(['name', 'contact', 'email', 'street']);
        session()->flash('message', 'Crowdworker added successfully!');
    }

    public function resetForm()
    {
        $this->reset(['name', 'contact', 'email', 'street']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.crowdworker');
    }
}
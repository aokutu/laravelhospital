<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Crowdworker as CrowdworkerModel;

class Crowdworker extends Component
{
    public $name;
    public $contact;
    public $email;
    public $street;
    public $crowdworkers = [];

    public function mount()
    {
          $this->loadCrowdworkers();
    }


    public function loadCrowdworkers()
{
    $this->crowdworkers = CrowdworkerModel::all()->toArray();
}


public function saveCrowdworker()
{
    $this->validate([
        'name' => 'required|string|max:255',
        'contact' => 'required|string|max:20',
        'email' => 'required|email',
        'street' => 'required|string|max:255',
    ]);

    CrowdworkerModel::create([
        'name' => $this->name,
        'contact' => $this->contact,
        'email' => $this->email,
        'street' => $this->street,
    ]);

    // Reload records from the database
    $this->loadCrowdworkers();

    // Clear the form
    $this->reset([
        'name',
        'contact',
        'email',
        'street',
    ]);

    session()->flash('message', 'Crowdworker added successfully!');
}


    public function resetForm()
    {
        $this->reset(['name', 'contact', 'email', 'street']);
        $this->resetErrorBag();
    }



    public function edit($id)
{
    dd("Edit customer ID: " . $id);
}

public function delete($id)
{
    dd("Delete customer ID: " . $id);
}


    public function render()
    {
        return view('livewire.crowdworker');
    }
}
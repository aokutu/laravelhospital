<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Crowdworker as CrowdworkerModel;

class Crowdworker extends Component
{
    use WithPagination;

    public $name;
    public $contact;
    public $email;
    public $street;


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


        $this->reset([
            'name',
            'contact',
            'email',
            'street',
        ]);


        $this->resetPage();

        session()->flash('message', 'Crowdworker added successfully!');
    }


    public function resetForm()
    {
        $this->reset([
            'name',
            'contact',
            'email',
            'street'
        ]);

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
        return view('livewire.crowdworker', [
            'crowdworkers' => CrowdworkerModel::paginate(3)
        ]);
    }
}
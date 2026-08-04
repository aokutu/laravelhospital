<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // 🔥 ADDED: Import the file handling engine
use App\Models\Crowdworker as CrowdworkerModel;

class Crowdworker extends Component
{
    use WithPagination;
    use WithFileUploads; // 🔥 ADDED: Unlock file upload storage pipelines

    // Existing Crowdworker state properties
    public $name;
    public $contact;
    public $email;
    public $street;

    // 🔥 ADDED: New single file tracking variable property
    public $uploadedFile;

    // Existing Crowdworker creation handler method
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

    // 🔥 ADDED: New method handler to process your file form submission block
    public function saveFile()
    {
        // 1. Validate file structure criteria security rules
        $this->validate([
            'uploadedFile' => 'required|file|max:10240', // Limit to 10MB maximum payload size
        ]);

        // 2. STORAGE EXTRACT: Save file securely inside public/storage/documents/ drawer folder
        // It automatically assigns a unique hashed filename to prevent overwrites!
        $storedPath = $this->uploadedFile->store('documents', 'public');

        // 3. Clear memory track values to empty the view layout form box
        $this->reset('uploadedFile');

        // 4. Notify UI layer with a distinct message
        session()->flash('file_message', 'Document uploaded and indexed successfully!');
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'contact',
            'email',
            'street',
            'uploadedFile' // ADDED: Clear out the file input state too if reset is hit
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

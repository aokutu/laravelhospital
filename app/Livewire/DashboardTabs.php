<?php


namespace App\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads; // 🔥 MANDATORY FOR FILE SELECTION SLOTS

class DashboardTabs extends Component
{


      use WithFileUploads; 
    // Updated options comment to include 'wizard'


     public $uploadedFile;
    public $activeTab = 'home'; // options: 'home', 'wizard', 'features', 'settings'

    public function switchTab($tabName)
    {
        // This takes the 'wizard' string passed from your button and saves it to memory
        $this->activeTab = $tabName;
    }
    


      public function saveFile()
    {
        // 1. Validate file structure criteria security rules
        $this->validate([
            'uploadedFile' => 'required|file|max:10240', // Limit to 10MB maximum payload size
        ]);

        // 2. STORAGE EXTRACT: Save file securely inside public/storage/documents/ drawer folder
        $storedPath = $this->uploadedFile->store('documents', 'public');

        // 3. Clear memory track values to empty the view layout form box
        $this->reset('uploadedFile');

        // 4. Notify UI layer with a distinct message
        session()->flash('file_message', 'Document uploaded and indexed successfully!');
    }


    public function render()
    {
        return view('livewire.dashboard-tabs');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;               // 🔥 Correct place for imports
use Illuminate\Support\Facades\Storage;       // 🔥 Correct place for imports


class RegistrationWizard extends Component
{
    public $currentStep = 1;
    public $totalSteps = 3;

    // Form tracking variables
    public $username, $password;
    public $company_name, $business_type;
    public $terms_accepted = false;

    // Define unshared validation splits per stage
    protected $validationRules = [
        1 => [
            'username' => 'required|min:4',
            'password' => 'required|min:6',
        ],
        2 => [
            'company_name' => 'required|string',
            'business_type' => 'required',
        ],
        3 => [
            'terms_accepted' => 'accepted',
        ],
    ];

    public function nextStep()
    {
        $this->validate($this->validationRules[$this->currentStep]);

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }




public function submitForm()
{
    // 1. Run final validation sweep
    $this->validate($this->validationRules[$this->totalSteps]);
    
    // 2. Pack data array to feed into the view file
    $data = [
        'username' => $this->username,
        'company_name' => $this->company_name,
        'business_type' => $this->business_type,
        'terms_accepted' => $this->terms_accepted
    ];

    // 3. Pre-load the view file blueprint into memory
    $pdf = Pdf::loadView('registration-pdf', $data);

    // 4. THE LIVEWIRE FIX: Save the file out to local public storage directory
    $filename = 'user_registration_' . time() . '.pdf';
    Storage::disk('public')->put('tmp/' . $filename, $pdf->output());

    // 5. Clean up tracking inputs and reset step counter back to page 1
    $this->reset(['username', 'password', 'company_name', 'business_type', 'terms_accepted', 'currentStep']);

    // 6. DISPATCH EVENT: Hand the clean file path directly out to the browser window
    //return $this->redirect(Storage::url('tmp/' . $filename), navigate: false);

      return $this->redirect(route('pdf.download', ['filename' => $filename]), navigate: false);
}





    public function render()
    {
        return view('livewire.registration-wizard');
    }
}

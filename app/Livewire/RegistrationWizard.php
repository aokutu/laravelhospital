<?php

namespace App\Livewire;

use Livewire\Component;

class RegistrationWizard extends Component
{
    public $currentStep = 1;
    public $totalSteps = 3;

    // Form tracking variables
    public $username, $password;
    public $company_name, $business_type;
    public $terms_accepted = false;

    // Define unshared validation splits per stage
    private $validationRules = [
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
        // Validate fields belonging only to the active view page
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
        // Final submit verification criteria sweep
        $this->validate($this->validationRules[$this->totalSteps]);
        
        session()->flash('message', 'Wizard registration processed successfully!');
        
        // Return back to fresh pipeline template values
        $this->reset(['username', 'password', 'company_name', 'business_type', 'terms_accepted', 'currentStep']);
    }

    public function render()
    {
        return view('livewire.registration-wizard');
    }
}

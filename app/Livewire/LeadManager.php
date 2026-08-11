<?php 

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Lead;
use App\Events\LeadCreated;


class LeadManager extends Component
{
    use WithPagination;

    // Form inputs
    public $first_name, $second_name, $email, $contact, $date, $location;
    
    // Control variables
    public $search = '';
    public $leadId;
    public $isEditMode = false;

    // Dropdown options
    public $locationsList = ['Nairobi', 'Mombasa', 'Kisumu', 'Nakuru', 'Eldoret'];

    // 1. DEFINE YOUR VALIDATION RULES HERE
    protected $rules = [
        'first_name' => 'required|string|min:2',
        'second_name' => 'required|string|min:2',
        'email' => 'required|email', // Removed unique constraint to keep setup simple, add back if needed
        'contact' => 'required|string|min:10',
        'date' => 'required|date',
        'location' => 'required|string',
    ];

    // 2. REAL-TIME VALIDATION: Validates individual fields as the user types/blurs
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        // 3. RUN VALIDATION ON SUBMIT
        $this->validate();

     $lead = Lead::updateOrCreate(
    ['id' => $this->leadId],
    [
        'first_name'  => $this->first_name,
        'second_name' => $this->second_name,
        'email'       => $this->email,
        'contact'     => $this->contact,
        'date'        => $this->date,
        'location'    => $this->location,
    ]
);


LeadCreated::dispatch($lead);

        session()->flash('message', $this->isEditMode ? 'Record updated successfully!' : 'Record added successfully!');
        
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        $this->leadId = $lead->id;
        $this->first_name = $lead->first_name;
        $this->second_name = $lead->second_name;
        $this->email = $lead->email;
        $this->contact = $lead->contact;
        $this->date = $lead->date;
        $this->location = $lead->location;
        
        $this->isEditMode = true;
    }

    public function delete($id)
    {
        Lead::findOrFail($id)->delete();
        session()->flash('message', 'Record deleted successfully!');
    }

    public function resetInputFields()
    {
        $this->reset(['first_name', 'second_name', 'email', 'contact', 'date', 'location', 'leadId', 'isEditMode']);
        $this->resetValidation();
    }

    public function render()
    {
        $leads = Lead::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('second_name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.lead-manager', [
            'leads' => $leads
        ]);
    }
}

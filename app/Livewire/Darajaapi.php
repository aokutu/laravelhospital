<?php

namespace App\Livewire;

use Livewire\Component;
use FelixMuhoro\Mpesa\Facades\Mpesa;
use Exception;

class Darajaapi extends Component
{
    public string $phone = '';
    public string $status = '';
    public string $message = '';
    
    // Add this property flag to resolve the undefined frontend crash!
    public bool $isSubmitted = false; 

    protected array $rules = [
        'phone' => ['required', 'regex:/^(07|01|2547|2541)\d{8}$/'],
    ];

    public function processForm()
    {
        $this->validate();
        
        $this->status = 'loading';
        $this->message = 'Processing secure checkout prompt...';
        $this->isSubmitted = true; // Set flag to true on processing

        try {
            $formattedPhone = $this->phone;
            if (str_starts_with($formattedPhone, '0')) {
                $formattedPhone = '254' . substr($formattedPhone, 1);
            }

            $response = Mpesa::stkPush(
                phone: $formattedPhone,
                amount: 1,
                reference: 'SI-PARK-' . rand(100, 999),
                description: 'Sandbox Livewire Test'
            );

            if ($response->accepted()) {
                $this->status = 'success';
                $this->message = 'STK Push prompt sent successfully to ' . $this->phone;
                $this->reset('phone'); 
            } else {
                $this->status = 'failed';
                $this->message = 'Safaricom refused the checkout request.';
            }
        } catch (Exception $e) {
            $this->status = 'failed';
            $this->message = 'Configuration error: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.darajaapi');
    }
}

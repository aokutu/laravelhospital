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

public function simulateIncomingPayment()
{
    // Array lists to make your demo random and exciting
    $firstNames = ['John', 'Mary', 'Kevin', 'Grace', 'Brian', 'Amina'];
    $lastNames = ['Mwangi', 'Onyango', 'Kamau', 'Otieno', 'Wanjiku', 'Ali'];
    $references = ['SHOP-99', 'TILL-04', 'INVOICE-A', 'ORDER-502'];

    // Generate random values for the transaction record block
    \App\Models\MpesaTransaction::create([
        'mpesa_code'  => 'SGH' . rand(10000, 99999),
        'amount'      => rand(150, 4500) . '.00',
        'phone'       => '2547' . rand(10000000, 99999999),
        'first_name'  => $firstNames[array_rand($firstNames)],
        'last_name'   => $lastNames[array_rand($lastNames)],
        'bill_ref'    => $references[array_rand($references)],
    ]);
}



}

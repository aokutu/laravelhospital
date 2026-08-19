<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MpesaTransaction;

class MpesaFeed extends Component
{
    public function render()
    {
        return view('livewire.mpesa-feed', [
            'transactions' => MpesaTransaction::latest()->take(5)->get()
        ]);
    }
} // 


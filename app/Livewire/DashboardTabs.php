<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardTabs extends Component
{
    // Updated options comment to include 'wizard'
    public $activeTab = 'home'; // options: 'home', 'wizard', 'features', 'settings'

    public function switchTab($tabName)
    {
        // This takes the 'wizard' string passed from your button and saves it to memory
        $this->activeTab = $tabName;
    }

    public function render()
    {
        return view('livewire.dashboard-tabs');
    }
}

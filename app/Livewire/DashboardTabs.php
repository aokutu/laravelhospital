<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardTabs extends Component
{
    public $activeTab = 'home'; // options: 'home', 'features', 'settings'

    public function switchTab($tabName)
    {
        $this->activeTab = $tabName;
    }

    public function render()
    {
        return view('livewire.dashboard-tabs');
    }
}

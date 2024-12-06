<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        return view('livewire.dashboard-component')->layout('components.layouts.app');
    }
}

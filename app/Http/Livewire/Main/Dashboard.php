<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.main.dashboard')
            -> layout('layouts.main');
    }
}

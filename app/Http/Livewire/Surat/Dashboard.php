<?php

namespace App\Http\Livewire\Surat;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.surat.dashboard')->layout('layouts.main');
    }
}

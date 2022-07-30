<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

class Dashboard extends Component
{
    public $commit;
    public $tag;
    public $deskripsi;

    public function mount()
    {
        $this->commit    = config('version.commit');
        $this->tag       = config('version.tag');
        $this->deskripsi = config('version.deskripsi');
    }

    public function render()
    {
        return view('livewire.main.dashboard')->layout('layouts.main');
    }
}

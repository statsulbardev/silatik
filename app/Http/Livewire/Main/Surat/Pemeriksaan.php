<?php

namespace App\Http\Livewire\Main\Surat;

use App\Models\Surat;
use Livewire\Component;

class Pemeriksaan extends Component
{
    public $surat;

    public function mount(Surat $surat)
    {
        $this->surat = $surat;
    }

    public function render()
    {
        return view('livewire.main.surat.pemeriksaan');
    }
}

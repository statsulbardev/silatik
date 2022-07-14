<?php

namespace App\Http\Livewire\Main\Surat;

use App\Models\Surat;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Disposisi extends Component
{
    public $tahapan;
    public $surat;

    public function mount(Surat $surat)
    {
        $this->surat = $surat;

        $this->tahapan = Route::currentRouteName();


    }

    public function render()
    {
        return view('livewire.main.surat.disposisi')
            -> layout('layouts.main');
    }
}

<?php

namespace App\Http\Livewire\Main\Surat;

use App\Models\Surat;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class DetailSurat extends Component
{
    public $surat;
    public $tipe;

    public function mount(Surat $surat)
    {
        $this->surat = $surat;
        $this->tipe  = Str::contains(Route::currentRouteName(), "masuk") ? "Masuk" : "Keluar";
    }

    public function render()
    {
        return view('livewire.detail-surat')->layout('layouts.main');
    }
}

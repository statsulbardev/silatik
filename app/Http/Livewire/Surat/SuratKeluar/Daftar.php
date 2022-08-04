<?php

namespace App\Http\Livewire\Surat\SuratKeluar;

use App\Traits\SuratTrait;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class Daftar extends Component
{
    use SuratTrait;

    public $tipe;
    public $daftar_surat;

    // public function mount()
    // {
    //     $this->tipe = Str::contains(Route::currentRouteName(), "masuk") ? "sm" : "sk";

    //     $this->daftar_surat = $this->getChiefMails($this->tipe);
    // }

    // public function render()
    // {
    //     return view('livewire.surat.surat-keluar.pemeriksaan')->layout('layouts.main');
    // }
}

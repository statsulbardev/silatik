<?php

namespace App\Http\Livewire\Main\Surat;

use App\Http\Traits\SuratTrait;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class DaftarSurat extends Component
{
    use SuratTrait;

    public $tipe_surat;

    public function mount()
    {
        switch(Route::currentRouteName()) {
            case 'surat-masuk':
                // cek role user yang bisa akses
                $this->tipe_surat = 'masuk';

                break;
            case 'surat-keluar':
                $this->tipe_surat = 'keluar';

                break;
        }
    }

    public function render()
    {
        return view('livewire.main.surat.daftar-surat', [
            'data' => $this->getAllData($this->tipe_surat)
        ])->layout('layouts.main');
    }
}

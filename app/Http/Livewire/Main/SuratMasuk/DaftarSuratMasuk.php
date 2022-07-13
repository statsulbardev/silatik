<?php

namespace App\Http\Livewire\Main\SuratMasuk;

use Livewire\Component;

class DaftarSuratMasuk extends Component
{
    public function render()
    {
        return view('livewire.main.surat-masuk.daftar-surat-masuk')
            -> layout('layouts.main');
    }
}

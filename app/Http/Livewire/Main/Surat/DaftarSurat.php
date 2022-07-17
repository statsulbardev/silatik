<?php

namespace App\Http\Livewire\Main\Surat;

use App\Traits\SuratTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class DaftarSurat extends Component
{
    use SuratTrait;

    public $tipe_surat;
    public $data;

    public function mount()
    {
        switch(Route::currentRouteName()) {
            case 'surat-masuk':
                $this->tipe_surat = 'masuk';
                
                break;
            case 'surat-keluar':
                $this->tipe_surat = 'keluar';

                break;
        }
    }

    public function render()
    {
        return view('livewire.main.surat.daftar-surat')->layout('layouts.main');
    }

    public function delete($id)
    {

    }
}

<?php

namespace App\Http\Livewire\Main\Surat;

use App\Traits\SuratTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class DaftarSurat extends Component
{
    use SuratTrait;

    public $tipe;
    public $role;
    public $routing;

    public $daftar_surat;

    public function mount()
    {
        $this->tipe = Str::contains(Route::currentRouteName(), "masuk") ? "sm" : "sk";
        $this->role = Auth::user()->roles[0]->name;
        $this->routing = $this->tipe == "sm" ? "surat-masuk" : "surat-keluar";

        switch ($this->role)
        {
            case 'kabps':
                $this->daftar_surat = $this->getChiefMails($this->tipe);
                break;
            case 'sekretaris':
                break;
            default;
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

<?php

namespace App\Http\Livewire\Surat\SuratMasuk;

use App\Traits\SuratTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Daftar extends Component
{
    use SuratTrait, WithPagination;

    public $tipe;
    public $routing;
    public $daftar_surat;
    public $nama_routing;

    public function mount()
    {
        $this->nama_routing = Route::currentRouteName();

        if (Str::contains($this->nama_routing, "masuk")) {
            $this->tipe  = "sm";
            $this->judul = "Surat Masuk";
        } else {
            $this->tipe  = "sk";
            $this->judul = "Surat Keluar";
        }

        switch (Auth::user()->roles->sortDesc()->max()->name)
        {
            case 'kabps':
                $this->daftar_surat = $this->getChiefMails($this->tipe, $this->nama_routing);
                break;
            case 'sekretaris':
                $this->daftar_surat = $this->getSecretaryMails($this->tipe);
                break;
            case 'kabag':
                $this->daftar_surat = $this->getCoordinatorMails($this->tipe, $this->nama_routing);
                break;
            case 'kf':
                $this->daftar_surat = $this->getCoordinatorMails($this->tipe, $this->nama_routing);
                break;
            case 'skf':
                $this->daftar_surat = $this->getSubCoordinatorMails($this->tipe, $this->nama_routing);
                break;
            case 'staf':
                $this->daftar_surat = $this->getStafMails($this->tipe);
                break;
        }
    }

    public function render()
    {
        return view('livewire.surat.surat-masuk.daftar')->layout('layouts.main');
    }

    public function delete($id)
    {
        $result = $this->deleteMail($id);

        $result
            ? session()->flash('messages', 'Sukses - Informasi surat telah dihapus.')
            : session()->flash('messages', 'Gagal - Informasi surat gagal dihapus.');

        return redirect()->back();
    }
}

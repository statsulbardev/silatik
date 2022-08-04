<?php

namespace App\Http\Livewire\Surat\SuratKeluar;

use App\Models\Surat;
use App\Repositories\RepositoriPemeriksaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class Pemeriksaan extends Component
{
    public $surat;
    public $tipe;
    public $judul;
    public $poin;
    public $catatan;
    public $role;

    protected $rules = [
        'poin'    => 'required',
        'catatan' => 'nullable|min:3'
    ];

    public function mount(Surat $surat)
    {
        $this->surat = $surat;
        $this->judul = "Surat Keluar";
        $this->role  = Auth::user()->roles->max()->name === "kabps" ? "kepala" : "kf";
    }

    public function render()
    {
        return view('livewire.surat.surat-keluar.pemeriksaan')->layout('layouts.main');
    }

    public function save(RepositoriPemeriksaan $repositoriPemeriksaan)
    {
        $this->validate();

        $result = $repositoriPemeriksaan->storeCheckMail(Auth::user()->roles->max()->name, $this);

        session()->flash('messages', $result);

        return redirect(url(env('APP_URL') . 'surat-keluar/' . $this->role));
    }
}

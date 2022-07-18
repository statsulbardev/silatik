<?php

namespace App\Http\Livewire\Main\Surat;

use App\Models\Surat;
use App\Models\UnitKerja;
use App\Repositories\RepositoriDisposisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class Disposisi extends Component
{
    public $surat;
    public $judul;
    public $role;
    public $redirectUrl;
    public $daftarUnitKerja;
    public $unitKerja;
    public $poin = [];
    public $penerima = [];
    public $catatan;

    protected $rules = [
        'unitKerja'  => 'required',
        'catatan'    => 'required|min:5'
    ];

    public function mount(Surat $surat)
    {
        $this->surat = $surat;
        $this->role  = Auth::user()->roles[0]->name;

        if (Str::contains(Route::currentRouteName(), "masuk")) {
            $this->judul = "Surat Masuk";
            $this->redirectUrl = "surat-masuk";
        } else {
            $this->judul = "Surat Keluar";
            $this->redirectUrl = "surat-keluar";
        }

        $this->daftarUnitKerja  = UnitKerja::get(['id', 'nama'])->toArray();
    }

    public function render()
    {
        return view('livewire.main.surat.disposisi')->layout('layouts.main');
    }

    public function updatedUnitFungsi($value)
    {
        array_push($this->penerima, $value);
    }

    public function save(RepositoriDisposisi $repositoriDisposisi)
    {
        $this->validate();

        $result = $repositoriDisposisi->store($this);

        session()->flash('messages', $result);

        return redirect(env('APP_URL'). $this->redirectUrl . '/kepala');
    }
}

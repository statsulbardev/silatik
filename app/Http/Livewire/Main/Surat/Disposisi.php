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
    public $poin = [];
    public $penerima = [];
    public $catatan;

    protected $rules = [
        'catatan'    => 'required|min:5'
    ];

    public function mount(Surat $surat)
    {
        $this->surat    = $surat;
        $this->role     = Auth::user()->roles[0]->name;
        $this->judul    = "Surat Masuk";
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

        return redirect(url(env('APP_URL'). 'surat-masuk/kepala/disposisi'));
    }
}

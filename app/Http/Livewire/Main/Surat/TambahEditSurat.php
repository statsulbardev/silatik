<?php

namespace App\Http\Livewire\Main\Surat;

use App\Traits\SuratTrait;
use App\Models\Surat;
use App\Repositories\RepositoriSurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class TambahEditSurat extends Component
{
    use WithFileUploads, SuratTrait;

    public $surat;
    public $action;
    public $routing;
    public $role;
    public $daftarTkKeamanan;

    public $no_agenda;
    public $tanggal_surat;
    public $no_surat;
    public $pengirim_surat;
    public $perihal_surat;
    public $file_surat;
    public $temp_file_surat;
    public $tipe;
    public $tk_keamanan;

    protected $rules = [
        'no_agenda'      => 'required|max:3',
        'tanggal_surat'  => 'required',
        'no_surat'       => 'required|min:3',
        'pengirim_surat' => 'required|min:3',
        'perihal_surat'  => 'required|min:5',
        'file_surat'     => 'nullable|mimes:jpeg,png,pdf'
    ];

    public function mount(Surat $surat)
    {
        $this->tipe    = Str::contains(Route::currentRouteName(), "masuk") ? "sm" : "sk";
        $this->action  = Str::contains(Route::currentRouteName(), "tambah") ? "tambah" : "edit";
        $this->routing = $this->tipe == "sm" ? "surat-masuk" : "surat-keluar";
        $this->role    = Auth::user()->roles->sortDesc()->max()->name;

        $this->daftarTkKeamanan = [
            ["id" => "SR", "nama" => "Sangat Rahasia"],
            ["id" => "R", "nama" => "Rahasia"],
            ["id" => "B", "nama" => "Biasa"]
        ];

        if ($this->action == "edit") {
            $this->surat           = $surat;
            $this->no_agenda       = $surat->no_agenda;
            $this->tanggal_surat   = $surat->tanggal_surat;
            $this->no_surat        = $surat->no_surat;
            $this->pengirim_surat  = $surat->pengirim;
            $this->perihal_surat   = $surat->perihal;
            $this->tk_keamanan     = $surat->tk_keamanan;
            $this->temp_file_surat = $surat->relasiBerkas->max()->tautan;
        }
    }

    public function render()
    {
        return view('livewire.main.surat.tambah-edit-surat')->layout('layouts.main');
    }

    public function create(RepositoriSurat $repositoriSurat)
    {
        $this->validate();

        $pesan = $repositoriSurat->store($this);

        session()->flash('messages', $pesan);

        return redirect(env('APP_URL') . $this->routing . '/' . $this->role);
    }

    public function edit(RepositoriSurat $repositoriSurat)
    {
        $this->validate();

        $pesan = $repositoriSurat->update($this);

        session()->flash('messages', $pesan);

        return redirect(env('APP_URL') . $this->routing . '/' . $this->role);
    }
}

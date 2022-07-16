<?php

namespace App\Http\Livewire\Main\Surat;

use App\Traits\SuratTrait;
use App\Models\Surat;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;

class TambahEditSurat extends Component
{
    use WithFileUploads, SuratTrait;

    public $no_agenda;
    public $tanggal_surat;
    public $no_surat;
    public $pengirim_surat;
    public $perihal_surat;
    public $file_surat;
    public $tahapan;
    public $surat;
    public $tipe_surat;
    public $routing;

    protected $rules = [
        'no_agenda'      => 'required|max:3',
        'tanggal_surat'  => 'required',
        'no_surat'       => 'required|min:3',
        'pengirim_surat' => 'required|min:3',
        'perihal_surat'  => 'required|min:5',
        'file_surat'     => 'required|mimes:jpeg,png,pdf'
    ];

    public function mount(Surat $surat)
    {
        switch(Route::currentRouteName()) {
            case 'tambah-surat-masuk' :
                $this->tipe_surat = 'masuk';
                $this->routing = 'surat-masuk';
                break;
            case 'edit-surat-masuk' :
                $this->surat         = $surat;
                $this->no_agenda     = $surat->no_agenda;
                $this->tanggal_surat = $surat->tanggal_surat;
                $this->no_surat      = $surat->no_surat;
                $this->sumber_surat  = $surat->pengirim_surat;
                $this->perihal_surat = $surat->perihal_surat;
                $this->file_surat    = $surat->tautan_surat;
                $this->tipe_surat    = 'masuk';
                $this->routing = 'surat-masuk';
                break;
            case 'tambah-surat-keluar' :
                $this->tipe_surat = 'keluar';
                $this->routing = 'surat-keluar';
                break;
            case 'edit-surat-keluar' :
                $this->tipe_surat = 'keluar';
                $this->routing = 'surat-keluar';
                break;
        }

        $this->tahapan = Route::currentRouteName();
    }

    public function render()
    {
        return view('livewire.main.surat.tambah-edit-surat')
            -> layout('layouts.main');
    }

    public function create()
    {
        $this->validate();

        $message = $this->store($this);

        session()->flash('messages', $message);

        return redirect(env('APP_URL') . $this->routing);
    }

    public function edit()
    {
        $this->validate();

        $this->update($this);
    }
}

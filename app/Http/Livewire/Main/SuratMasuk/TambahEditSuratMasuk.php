<?php

namespace App\Http\Livewire\Main\SuratMasuk;

use App\Http\Traits\SuratMasukTrait;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;

class TambahEditSuratMasuk extends Component
{
    use WithFileUploads, SuratMasukTrait;

    // untuk nomor agenda surat,
    // nanti dibuat terpisah jika yang login role dari sekretaris maka agenda sekretaris yang terbaca
    // jika umum maka no agenda umum yang terbaca
    public $no_agenda;
    public $tanggal_surat;
    public $no_surat;
    public $pengirim_surat;
    public $perihal_surat;
    public $file_surat;
    public $tahapan;
    public $surat;

    public function mount(SuratMasuk $surat)
    {
        $this->tahapan = Route::currentRouteName();

        if ($this->tahapan === 'edit-surat-masuk') {
            $this->surat         = $surat;
            $this->no_agenda     = $surat->no_agenda_sekretaris ?? $surat->no_agenda_umum;
            $this->tanggal_surat = $surat->tanggal_surat;
            $this->no_surat      = $surat->no_surat;
            $this->sumber_surat  = $surat->pengirim_surat;
            $this->perihal_surat = $surat->perihal_surat;
            $this->file_surat    = $surat->tautan_surat;
        }
    }

    public function render()
    {
        return view('livewire.main.surat-masuk.tambah-edit-surat-masuk')
            -> layout('layouts.main');
    }

    public function save()
    {
        dd($this);
    }
}

<?php

namespace App\Http\Livewire\Main\Surat;

use App\Models\Surat;
use App\Models\SuratBaca;
use App\Traits\HasReadMails;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class DetailSurat extends Component
{
    use HasReadMails;

    public $surat;
    public $tipe;
    public $pembaca;

    public function mount(Surat $surat)
    {
        $this->surat   = $surat;
        $this->tipe    = Str::contains(Route::currentRouteName(), "masuk") ? "Masuk" : "Keluar";

        $surat_baca = SuratBaca::where('surat_id', $surat->id)->get();

        $this->pembaca = $surat_baca->count() > 0
                       ? $surat_baca->pluck('pegawai_id')->toArray()[0]
                       : [];
    }

    public function render()
    {
        return view('livewire.detail-surat')->layout('layouts.main');
    }

    public function hasRead($userId, $suratId)
    {
        $this->storeReaderInfo($userId, $suratId);
    }
}

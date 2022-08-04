<?php

namespace App\Http\Livewire\Surat\SuratMasuk;

use App\Models\Surat;
use App\Models\SuratBaca;
use App\Traits\HasReadMails;
use Livewire\Component;

class Detail extends Component
{
    use HasReadMails;

    public $surat;
    public $pembaca;

    public function mount(Surat $surat)
    {
        $this->surat = $surat;

        $surat_baca  = SuratBaca::where('surat_id', $surat->id)->get();

        $this->pembaca = $surat_baca->count() > 0
                       ? $surat_baca->pluck('pegawai_id')->toArray()[0]
                       : [];
    }

    public function render()
    {
        return view('livewire.surat.surat-masuk.detail')->layout('layouts.main');
    }

    public function hasRead($userId, $suratId)
    {
        $this->storeReaderInfo($userId, $suratId);
    }
}

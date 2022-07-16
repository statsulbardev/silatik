<?php

namespace App\Http\Livewire\Main\Surat;

use App\Models\Surat;
use App\Models\UnitFungsi;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class Disposisi extends Component
{
    public $daftarUnitKerja;
    public $daftarUnitFungsi;
    public $pegawai;

    public $unitKerja = null;
    public $unitFungsi = null;
    public $tahapan;
    public $surat;
    public $poin = [];
    public $penerima = [];
    public $catatan;

    private $backrouting;

    public function mount(Surat $surat)
    {
        $this->surat = $surat;

        $this->tahapan = Route::currentRouteName();

        $this->backrouting = Str::contains($this->tahapan, 'masuk')
            ? 'surat-masuk'
            : 'surat-keluar';

        if ($surat->relasiPemeriksaan->max()->cek_kepala !== 'op') {
            session()->flash('messages', 'Gagal - Surat ini belum / tidak dapat di disposisi.');

            return redirect(env('APP_URL') . $this->backrouting);
        }

    }

    public function render()
    {
        $this->daftarUnitKerja  = UnitKerja::get(['id', 'nama']);

        if ($this->unitKerja === 'null') {
            $temp = UnitKerja::find((int) $this->unitKerja);
            $this->daftarUnitFungsi = $temp->relasiUnitFungsi;
        } else {
            $this->daftarUnitFungsi = [];
        }

        return view('livewire.main.surat.disposisi')
            -> layout('layouts.main');
    }
}

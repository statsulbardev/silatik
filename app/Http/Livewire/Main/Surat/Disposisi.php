<?php

namespace App\Http\Livewire\Main\Surat;

use App\Models\Pegawai;
use App\Models\Surat;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class Disposisi extends Component
{
    public $daftarUnitKerja;
    public $daftarUnitFungsi;

    public $unitKerja = null;
    public $unitFungsi = null;
    public $tahapan;
    public $surat;
    public $poin = [];
    public $penerima = [];
    public $catatan;

    public $tempUnitKerja;
    public $tempUnitFungsi;

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

        $this->daftarUnitKerja  = UnitKerja::get(['id', 'nama']);
    }

    public function render()
    {
        return view('livewire.main.surat.disposisi')
            -> layout('layouts.main');
    }

    public function updatedUnitKerja($value)
    {
        $this->tempUnitKerja = (int) $value;

        $temp = UnitKerja::find((int) $value);

        $this->daftarUnitFungsi = $temp->id > 1
            ? $temp->relasiUnitFungsi
            : $temp->relasiUnitFungsi->where('parent', 1);
    }

    public function updatedUnitFungsi($value)
    {
        $this->tempUnitFungsi = (int) $value;

        array_push($this->penerima, $value);
    }
}

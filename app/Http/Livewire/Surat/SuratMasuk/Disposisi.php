<?php

namespace App\Http\Livewire\Surat\SuratMasuk;

use App\Models\Surat;
use App\Models\UnitFungsi;
use App\Repositories\RepositoriDisposisi;
use App\Traits\HasReadMails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Disposisi extends Component
{
    use HasReadMails;

    public $surat;
    public $judul;
    public $role;
    public $poin = [];
    public $penerima = [];
    public $catatan;
    public $unitFungsi;

    protected $rulesKepala = [
        'poin'     => 'required',
        'penerima' => 'required',
        'catatan'  => 'required|min:5'
    ];

    protected $rulesNonKepala = [
        'penerima' => 'required',
        'catatan'  => 'required|min:5'
    ];

    public function mount(Surat $surat)
    {
        $user = Auth::user();

        $this->surat = $surat;
        $this->role  = $user->roles[0]->name;
        $this->judul = "Surat Masuk";

        $this->unitFungsi = !$user->hasAnyRole('kabag', 'kf')
                          ?: UnitFungsi::where('parent', $user->unit_fungsi_id)->get();
    }

    public function render()
    {
        return view('livewire.surat.surat-masuk.disposisi')->layout('layouts.main');
    }

    public function updatedUnitFungsi($value)
    {
        array_push($this->penerima, $value);
    }

    public function save(RepositoriDisposisi $repositoriDisposisi)
    {
        switch($this->role)
        {
            case 'kabps' :
                $this->validate($this->rulesKepala);

                $result = $repositoriDisposisi->store($this);

                session()->flash('messages', $result);

                return redirect(url(env('APP_URL'). 'surat-masuk/kepala/disposisi'));

                break;
            default:
                $this->validate($this->rulesNonKepala);

                $result = $repositoriDisposisi->update($this);

                session()->flash('messages', $result);

                return redirect(url(env('APP_URL') . 'surat-masuk/' . $this->role . '/disposisi'));
        }
    }

    public function hasRead($userId, $suratId)
    {
        $this->storeReaderInfo($userId, $suratId);
    }
}

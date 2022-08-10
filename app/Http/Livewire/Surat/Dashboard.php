<?php

namespace App\Http\Livewire\Surat;

use App\Models\Surat;
use App\Traits\DashboardInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    use DashboardInfo;

    public $sm_berjalan;
    public $sk_berjalan;
    public $sm_total;
    public $sk_total;
    public $sm_disposisi;
    public $sk_periksa;

    public function mount()
    {
        $pegawai  = Auth::user();
        $roleName = $pegawai->roles->sortDesc()->max()->name;

        if ($pegawai->hasAnyRole(['kabps', 'kabag', 'kf'])) {
            $this->sm_total         = $this->getTotalInboxMails($roleName, $pegawai);
            $this->sm_sdh_disposisi = $this->getDoneDisposition($roleName, $pegawai);
            $this->sm_disposisi     = $this->getDisposition($roleName, $pegawai);
        }
    }

    public function render()
    {
        return view('livewire.surat.dashboard')->layout('layouts.main');
    }
}

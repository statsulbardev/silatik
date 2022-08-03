<a href={{ route($route, $surat->id) }} class="badge {{ is_null($surat->relasiSuratBaca) ? 'badge-danger' : 'badge-primary' }} mb-1 text-white" style="cursor: pointer">
    <i class="fas fa-check-double"></i> Dibaca
    {{ is_null($surat->relasiSuratBaca) ? 0 : count($surat->relasiSuratBaca->pegawai_id) }}
    Orang
</a>

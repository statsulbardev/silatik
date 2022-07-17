<?php

namespace App\Traits;

use App\Http\Livewire\Main\Surat\DaftarPemeriksaan;
use App\Models\BerkasSurat;
use App\Models\Pemeriksaan;
use App\Models\Surat;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait SuratTrait
{
    use GoogleDriveTrait;

    public function store($data)
    {
        try {
            $path_surat = !is_null($data->file_surat)
                ? $this->uploadFile($data->tipe_surat === 'masuk' ? config('googleid.surat_masuk') : config('googleid.surat_keluar'), 'create', $data->file_surat)
                : null;

            DB::beginTransaction();

            $surat = Surat::create([
                'no_agenda'      => $data->no_agenda,
                'tanggal_surat'  => Carbon::parse($data->tanggal_surat, Auth::user()->timezone),
                'no_surat'       => $data->no_surat,
                'pengirim'       => $data->pengirim_surat,
                'perihal'        => $data->perihal_surat,
                'tipe'           => $data->tipe_surat,
                'tk_keamanan'    => $data->tk_keamanan,
                'pegawai_id'     => Auth::user()->id,
                'unit_kerja_id'  => Auth::user()->unit_kerja_id,
                'unit_fungsi_id' => Auth::user()->unit_fungsi_id
            ]);

            $berkas = BerkasSurat::create([
                'surat_id' => $surat->id,
                'tautan'   => $path_surat,
            ]);

            Pemeriksaan::create([
                'surat_id'        => $surat->id,
                'berkas_surat_id' => $berkas->id
            ]);

            DB::commit();

            $message = "Sukses - Informasi surat " . $data->tipe_surat . ' ' . $data->no_surat . " telah disimpan.";

        } catch(Exception $error) {
            DB::rollBack();

            is_null($path_surat) ?: $this->deleteFile($path_surat);

            Log::alert($error->getMessage());

            $message = "Gagal - Informasi surat " . $data->tipe_surat . ' ' . $data->no_surat . " gagal disimpan. Pesan error : " . $error->getMessage();
        }

        return $message;
    }

    public function update($data)
    {
        try {
            DB::beginTransaction();

            $data->surat->update([

            ]);

            DB::commit();

            $message = '';

        } catch(Exception $error) {
            DB::rollBack();

            $message = '';
        }

        return $message;
    }

    public function getSecretaryMails($tipe)
    {
        return Surat::query()
            -> with(['relasiPegawai', 'relasiDisposisi'])
            -> where('tipe', $tipe)
            -> get();
    }

    public function getChiefMails($tipe)
    {
        return Surat::query()
            -> with(['relasiPegawai', 'relasiDisposisi'])
            -> where('tipe', $tipe)
            -> where('cek_kepala', 'bp')
            -> get();
    }
}

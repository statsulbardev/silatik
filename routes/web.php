<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Pengaturan\UbahPassword;
use App\Http\Livewire\Surat\Dashboard;
use App\Http\Livewire\Surat\SuratMasuk\Daftar as DaftarSuratMasuk;
use App\Http\Livewire\Surat\SuratMasuk\Disposisi;
use App\Http\Livewire\Surat\SuratMasuk\Detail as DetailSuratMasuk;
use App\Http\Livewire\Surat\SuratMasuk\TambahEdit as TambahEditSuratMasuk;
use App\Http\Livewire\Version\Info;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::get('login', Login::class)->name('login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('ubah-password', UbahPassword::class)->name('ubah-password');

    Route::group(['middleware' => 'ganti_password'], function() {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('versi', Info::class)->name('versi');

        Route::group(['middleware' => ['role:kabps']], function() {
            // Surat Masuk
            Route::get('surat-masuk/kepala', DaftarSuratMasuk::class)->name('kepala-daftar-surat-masuk');
            Route::get('surat-masuk/kepala/disposisi', DaftarSuratMasuk::class)->name('kepala-disposisi-daftar-surat-masuk');
            Route::get('surat-masuk/kepala/disposisi/{surat}', Disposisi::class)->name('kepala-disposisi-surat-masuk');
            Route::get('surat-masuk/kepala/{surat}', DetailSuratMasuk::class)->name('kepala-detail-surat-masuk');

            // Surat Keluar
            // Route::get('surat-keluar/kepala', DaftarSurat::class)->name('kepala-surat-keluar');
            // Route::get('surat-keluar/kepala/periksa', DaftarSurat::class)->name('kepala-periksa-daftar-surat-keluar');
            // Route::get('surat-keluar/kepala/{surat}', DetailSurat::class)->name('kepala-detail-surat-keluar');
            // Route::get('surat-keluar/kepala/{surat}/periksa', Pemeriksaan::class)->name('kepala-periksa-surat-keluar');
        });

        Route::group(['middleware' => ['role:kabag']], function() {
            // Surat Masuk
            Route::get('surat-masuk/kabag', DaftarSuratMasuk::class)->name('kabag-daftar-surat-masuk');
            Route::get('surat-masuk/kabag/disposisi', DaftarSuratMasuk::class)->name('kabag-disposisi-daftar-surat-masuk');
            Route::get('surat-masuk/kabag/{surat}/disposisi', Disposisi::class)->name('kabag-disposisi-surat-masuk');
            Route::get('surat-masuk/kabag/{surat}', DetailSuratMasuk::class)->name('kabag-detail-surat-masuk');


            // Surat Keluar
            // Route::get('surat-keluar/kabag', DaftarSurat::class)->name('kabag-surat-keluar');
            // Route::get('surat-keluar/kabag/periksa', DaftarSurat::class)->name('kabag-periksa-daftar-surat-keluar');
            // Route::get('surat-keluar/kabag/{surat}', DetailSurat::class)->name('kabag-detail-surat-keluar');
            // Route::get('surat-keluar/kabag/{surat}/periksa', Pemeriksaan::class)->name('kabag-periksa-surat-keluar');
        });

        Route::group(['middleware' => ['role:kf']], function() {
            // Surat Masuk
            Route::get('surat-masuk/kf', DaftarSuratMasuk::class)->name('kf-daftar-surat-masuk');
            Route::get('surat-masuk/kf/disposisi', DaftarSuratMasuk::class)->name('kf-disposisi-daftar-surat-masuk');
            Route::get('surat-masuk/kf/{surat}/disposisi', Disposisi::class)->name('kf-disposisi-surat-masuk');
            Route::get('surat-masuk/kf/{surat}', DetailSuratMasuk::class)->name('kf-detail-surat-masuk');

            // Surat Keluar
            // Route::get('surat-keluar/kf', DaftarSurat::class)->name('kf-surat-keluar');
            // ROute::get('surat-keluar/kf/periksa', DaftarSurat::class)->name('kf-periksa-daftar-surat-keluar');
            // Route::get('surat-keluar/kf/{surat}', DetailSurat::class)->name('kf-detail-surat-keluar');
            // Route::get('surat-keluar/kf/{surat}/periksa', Pemeriksaan::class)->name('kf-periksa-surat-keluar');
        });

        Route::group(['middleware' => ['role:skf']], function() {
            // Surat Masuk
            Route::get('surat-masuk/skf', DaftarSuratMasuk::class)->name('skf-daftar-surat-masuk');
            Route::get('surat-masuk/skf/tambah', TambahEditSuratMasuk::class)->middleware('cek_umum')->name('skf-tambah-surat-masuk');
            Route::get('surat-masuk/skf/edit/{surat}', TambahEditSuratMasuk::class)->middleware('cek_umum')->name('skf-edit-surat-masuk');
            Route::get('surat-masuk/skf/{surat}', DetailSuratMasuk::class)->name('skf-detail-surat-masuk');
        });

        Route::group(['middleware' => ['role:sekretaris']], function() {
            // Surat Masuk
            Route::get('surat-masuk/sekretaris', DaftarSuratMasuk::class)->name('sekretaris-daftar-surat-masuk');
            Route::get('surat-masuk/sekretaris/tambah', TambahEditSuratMasuk::class)->name('sekretaris-tambah-surat-masuk');
            Route::get('surat-masuk/sekretaris/edit/{surat}', TambahEditSuratMasuk::class)->name('sekretaris-edit-surat-masuk');
            Route::get('surat-masuk/sekretaris/{surat}', DetailSuratMasuk::class)->name('sekretaris-detail-surat-masuk');
        });

        Route::group(['middleware' => ['role:staf']], function() {
            // Surat Masuk
            Route::get('surat-masuk/staf', DaftarSuratMasuk::class)->name('staf-daftar-surat-masuk');
            Route::get('surat-masuk/staf/tambah', TambahEditSuratMasuk::class)->middleware('cek_umum')->name('staf-tambah-surat-masuk');
            Route::get('surat-masuk/staf/{surat}', DetailSuratMasuk::class)->name('staf-detail-surat-masuk');

            // Surat Keluar
            // Route::get('surat-keluar/staf', DaftarSurat::class)->name('staf-surat-keluar');
            // Route::get('surat-keluar/staf/tambah', TambahEditSurat::class)->name('staf-tambah-surat-keluar');
            // Route::get('surat-keluar/staf/edit/{surat}', TambahEditSurat::class)->name('staf-edit-surat-keluar');
            // Route::get('surat-keluar/staf/{surat}', DetailSurat::class)->name('staf-detail-surat-keluar');
        });
    });
});

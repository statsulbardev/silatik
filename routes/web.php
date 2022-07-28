<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Main\Dashboard;
use App\Http\Livewire\Main\Surat\DaftarSurat;
use App\Http\Livewire\Main\Surat\Disposisi;
use App\Http\Livewire\Main\Surat\DetailSurat;
use App\Http\Livewire\Main\Surat\Pemeriksaan;
use App\Http\Livewire\Main\Surat\TambahEditSurat;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::get('login', Login::class)->name('login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    /*--------------------------------------- Surat Masuk ---------------------------------------*/

    Route::group(['middleware' => ['role:kabps']], function() {
        // Surat Masuk
        Route::get('surat-masuk/kepala', DaftarSurat::class)->name('kepala-surat-masuk');
        Route::get('surat-masuk/kepala/disposisi', DaftarSurat::class)->name('kepala-disposisi-daftar-surat-masuk');
        Route::get('surat-masuk/kepala/{surat}/disposisi', Disposisi::class)->name('kepala-disposisi-surat-masuk');
        Route::get('surat-masuk/kepala/{surat}', DetailSurat::class)->name('kepala-detail-surat-masuk');

        // Surat Keluar
        Route::get('surat-keluar/kepala', DaftarSurat::class)->name('kepala-surat-keluar');
        Route::get('surat-keluar/kepala/periksa', DaftarSurat::class)->name('kepala-periksa-daftar-surat-keluar');
        Route::get('surat-keluar/kepala/{surat}', DetailSurat::class)->name('kepala-detail-surat-keluar');
        Route::get('surat-keluar/kepala/{surat}/periksa', Pemeriksaan::class)->name('kepala-periksa-surat-keluar');
    });

    Route::group(['middleware' => ['role:sekretaris']], function() {
        // Surat Masuk
        Route::get('surat-masuk/sekretaris', DaftarSurat::class)->name('sekretaris-surat-masuk');
        Route::get('surat-masuk/sekretaris/tambah', TambahEditSurat::class)->name('sekretaris-tambah-surat-masuk');
        Route::get('surat-masuk/sekretaris/edit/{surat}', TambahEditSurat::class)->name('sekretaris-edit-surat-masuk');
        Route::get('surat-masuk/sekretaris/{surat}', DetailSurat::class)->name('sekretaris-detail-surat-masuk');
    });

    Route::group(['middleware' => ['role:kf']], function() {
        // Surat Masuk
        Route::get('surat-masuk/kf', DaftarSurat::class)->name('kf-surat-masuk');
        Route::get('surat-masuk/kf/{surat}', DetailSurat::class)->name('kf-detail-surat-masuk');

        // Surat Keluar
        Route::get('surat-keluar/kf', DaftarSurat::class)->name('kf-surat-keluar');
        ROute::get('surat-keluar/kf/periksa', DaftarSurat::class)->name('kf-periksa-daftar-surat-keluar');
        Route::get('surat-keluar/kf/{surat}', DetailSurat::class)->name('kf-detail-surat-keluar');
        Route::get('surat-keluar/kf/{surat}/periksa', Pemeriksaan::class)->name('kf-periksa-surat-keluar');
    });

    Route::group(['middleware' => ['role:kabag']], function() {
        // Surat Masuk
        Route::get('surat-masuk/kabag', DaftarSurat::class)->name('kabag-surat-masuk');
        Route::get('surat-masuk/kabag/disposisi', DaftarSurat::class)->name('kabag-disposisi-daftar-surat-masuk');
        Route::get('surat-masuk/kabag/{surat}/disposisi', Disposisi::class)->name('kabag-disposisi-surat-masuk');
        Route::get('surat-masuk/kabag/{surat}', DetailSurat::class)->name('kabag-detail-surat-masuk');


        // Surat Keluar
        Route::get('surat-keluar/kabag', DaftarSurat::class)->name('kabag-surat-keluar');
        Route::get('surat-keluar/kabag/periksa', DaftarSurat::class)->name('kabag-periksa-daftar-surat-keluar');
        Route::get('surat-keluar/kabag/{surat}', DetailSurat::class)->name('kabag-detail-surat-keluar');
        Route::get('surat-keluar/kabag/{surat}/periksa', Pemeriksaan::class)->name('kabag-periksa-surat-keluar');
    });

    Route::group(['middleware' => ['role:skf']], function() {
        // Surat Masuk
        Route::get('surat-masuk/skf', DaftarSurat::class)->name('skf-surat-masuk');
        Route::get('surat-masuk/skf/tambah', TambahEditSurat::class)->name('skf-tambah-surat-masuk');
        Route::get('surat-masuk/skf/{surat}', DetailSurat::class)->name('skf-detail-surat-masuk');
    });

    Route::group(['middleware' => ['role:staf']], function() {
        // Surat Masuk
        Route::get('surat-masuk/staf', DaftarSurat::class)->name('staf-surat-masuk');
        Route::get('surat-masuk/staf/tambah', TambahEditSurat::class)->middleware('cek_umum')->name('staf-tambah-surat-masuk');
        Route::get('surat-masuk/staf/{surat}', DetailSurat::class)->name('staf-detail-surat-masuk');

        // Surat Keluar
        Route::get('surat-keluar/staf', DaftarSurat::class)->name('staf-surat-keluar');
        Route::get('surat-keluar/staf/tambah', TambahEditSurat::class)->name('staf-tambah-surat-keluar');
        Route::get('surat-keluar/staf/edit/{surat}', TambahEditSurat::class)->name('staf-edit-surat-keluar');
        Route::get('surat-keluar/staf/{surat}', DetailSurat::class)->name('staf-detail-surat-keluar');
    });
});

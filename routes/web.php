<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Main\Dashboard;
use App\Http\Livewire\Main\Surat\DaftarSurat;
use App\Http\Livewire\Main\Surat\Disposisi;
use App\Http\Livewire\Main\Surat\DaftarPemeriksaan;
use App\Http\Livewire\Main\Surat\DetailSurat;
use App\Http\Livewire\Main\Surat\TambahEditSurat;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::get('login', Login::class)->name('login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    /*--------------------------------------- Surat Masuk ---------------------------------------*/

    // Kepala BPS
    Route::get('surat-masuk/kepala', DaftarSurat::class)->name('kepala-surat-masuk');
    Route::get('surat-masuk/kepala/{surat}/disposisi', Disposisi::class)->name('kepala-disposisi-surat-masuk');
    Route::get('surat-masuk/kepala/{surat}', DetailSurat::class)->name('kepala-detail-surat-masuk');

    // Sekretaris
    Route::get('surat-masuk/sekretaris', DaftarSurat::class)->name('sekretaris-surat-masuk');
    Route::get('surat-masuk/sekretaris/tambah', TambahEditSurat::class)->name('sekretaris-tambah-surat-masuk');
    Route::get('surat-masuk/sekretaris/edit/{surat}', TambahEditSurat::class)->name('sekretaris-edit-surat-masuk');
    Route::get('surat-masuk/sekretaris/{surat}', DetailSurat::class)->name('sekretaris-detail-surat-masuk');

    // Kabag/Subag Umum

    // Koordinator Fungsi

    // Subkoordinator Fungsi

    // Staf

    /*--------------------------------------- Surat Keluar ---------------------------------------*/

    // Koordinator Fungsi
    Route::get('surat-keluar/kf', DaftarSurat::class)->name('kf-surat-keluar');

    // Staf
    Route::get('surat-keluar/staf', DaftarSurat::class)->name('staf-surat-keluar');
    Route::get('surat-keluar/staf/tambah', TambahEditSurat::class)->name('staf-tambah-surat-keluar');
    Route::get('surat-keluar/staf/edit/{surat}', TambahEditSurat::class)->name('staf-edit-surat-keluar');
    Route::get('surat-keluar/staf/{surat}', DetailSurat::class)->name('staf-detail-surat-keluar');
});

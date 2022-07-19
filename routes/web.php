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

    // Routing surat masuk untuk kepala bps
    Route::get('surat-masuk/kepala', DaftarSurat::class)->name('kepala-surat-masuk');
    Route::get('surat-masuk/kepala/{surat}/disposisi', Disposisi::class)->name('kepala-disposisi-surat-masuk');
    Route::get('surat-masuk/kepala/{surat}', DetailSurat::class)->name('detail-kepala-surat-masuk');

    // Routing surat masuk untuk sekretaris
    Route::get('surat-masuk/sekretaris', DaftarSurat::class)->name('sekretaris-surat-masuk');
    Route::get('surat-masuk/sekretaris/tambah', TambahEditSurat::class)->name('sekretaris-tambah-surat-masuk');
    Route::get('surat-masuk/sekretaris/edit/{surat}', TambahEditSurat::class)->name('sekretaris-edit-surat-masuk');
    Route::get('surat-masuk/sekretaris/{surat}', DetailSurat::class)->name('sekretaris-detail-surat-masuk');

    // Routing surat masuk untuk kf

    Route::get('surat-keluar', DaftarSurat::class)->name('surat-keluar');
    Route::get('surat-keluar/tambah', TambahEditSurat::class)->name('tambah-surat-keluar');
    Route::get('surat-keluar/edit/{surat}', TambahEditSurat::class)->name('edit-surat-keluar');
    Route::get('surat-masuk/{surat}/disposisi', Disposisi::class)->name('disposisi-surat-masuk');
    Route::get('surat-keluar/{surat}/disposisi', Disposisi::class)->name('disposisi-surat-keluar');
});

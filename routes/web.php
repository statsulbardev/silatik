<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Main\Dashboard;
use App\Http\Livewire\Main\Surat\DaftarSurat;
use App\Http\Livewire\Main\Surat\TambahEditSurat;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::get('login', Login::class)->name('login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('surat-masuk', DaftarSurat::class)->name('surat-masuk');
    Route::get('surat-masuk/tambah', TambahEditSurat::class)->name('tambah-surat-masuk');
    Route::get('surat-masuk/edit/{surat}', TambahEditSurat::class)->name('edit-surat-masuk');
    Route::get('surat-keluar', DaftarSurat::class)->name('surat-keluar');
    Route::get('surat-keluar/tambah', TambahEditSurat::class)->name('tambah-surat-keluar');
    // Route::get('surat-keluar/edit/{surat}', TambahEditSuratKeluar::class)->name('edit-surat-keluar');
});

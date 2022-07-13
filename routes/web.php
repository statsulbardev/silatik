<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Main\Dashboard;
use App\Http\Livewire\Main\SuratKeluar\DaftarSuratKeluar;
use App\Http\Livewire\Main\SuratKeluar\TambahEditSuratKeluar;
use App\Http\Livewire\Main\SuratMasuk\DaftarSuratMasuk;
use App\Http\Livewire\Main\SuratMasuk\TambahEditSuratMasuk;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::get('login', Login::class)->name('login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('surat-masuk', DaftarSuratMasuk::class)->name('surat-masuk');
    Route::get('surat-masuk/tambah', TambahEditSuratMasuk::class)->name('tambah-surat-masuk');
    Route::get('surat-masuk/edit/{surat}', TambahEditSuratMasuk::class)->name('edit-surat-masuk');
    Route::get('surat-keluar', DaftarSuratKeluar::class)->name('surat-keluar');
    Route::get('surat-keluar/tambah', TambahEditSuratKeluar::class)->name('tambah-surat-keluar');
    Route::get('surat-keluar/edit/{surat}', TambahEditSuratKeluar::class)->name('edit-surat-keluar');
});

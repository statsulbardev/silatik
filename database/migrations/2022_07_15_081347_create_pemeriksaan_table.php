<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id');
            $table->unsignedBigInteger('berkas_id');
            $table->char('cek_kepala')->default('bp');
            $table->text('catatan_kepala')->nullable();
            $table->timestamp('tgl_cek_kepala')->nullable();
            $table->char('cek_kf')->default('bp');
            $table->text('catatan_kf')->nullable();
            $table->timestamp('tgl_cek_kf')->nullable();
            $table->timestamp('tanggal_buat');
            $table->timestamp('tanggal_update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaan');
    }
}

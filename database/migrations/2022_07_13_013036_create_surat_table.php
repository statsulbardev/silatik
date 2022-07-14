<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('no_agenda')->nullable();
            $table->timestamp('tanggal_surat')->index();
            $table->string('no_surat')->index();
            $table->string('pengirim_surat')->index();
            $table->string('perihal_surat')->index();
            $table->string('tautan_surat');
            $table->string('tipe_surat');
            $table->boolean('usul_disposisi')->default(false);
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('unit_kerja_id');
            $table->unsignedBigInteger('unit_fungsi_id');
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
        Schema::dropIfExists('surat');
    }
}

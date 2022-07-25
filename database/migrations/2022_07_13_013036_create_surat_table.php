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
            $table->unsignedInteger('no_agenda');
            $table->timestamp('tanggal_surat')->index();
            $table->string('no_surat');
            $table->string('pengirim')->index();
            $table->string('perihal')->index();
            $table->enum('tipe', ['sm', 'sk']);
            $table->enum('tk_keamanan', ['SR', 'R', 'B']);
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('unit_kerja_id');
            $table->unsignedBigInteger('unit_fungsi_id');
            $table->timestamp('tanggal_buat')->index();
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

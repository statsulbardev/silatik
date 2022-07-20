<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->index();
            $table->string('username')->index();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->string('nip_bps')->index();
            $table->string('nip_bkn')->index();
            $table->boolean('aktif');
            $table->string('foto')->nullable();
            $table->string('telegram_id')->nullable();
            $table->unsignedInteger('unit_kerja_id')->nullable();
            $table->unsignedInteger('unit_fungsi_id')->nullable();
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
        Schema::dropIfExists('pegawai');
    }
}

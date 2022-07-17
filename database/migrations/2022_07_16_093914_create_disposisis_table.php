<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id');
            $table->json('poin');
            $table->string('unit_kerja_penerima');
            $table->json('unit_fungsi_penerima')->nullable();
            $table->json('pegawai_penerima')->nullable();
            $table->string('kode_paraf');
            $table->text('catatan');
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
        Schema::dropIfExists('disposisis');
    }
}

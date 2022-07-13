<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal_surat')->index();
            $table->string('no_surat')->index();
            $table->string('sumber_surat')->index();
            $table->string('perihal_surat')->index();
            $table->string('tautan_surat');
            $table->unsignedInteger('no_agenda_sekretaris')->nullable();
            $table->unsignedInteger('no_agenda_umum')->nullable();
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
        Schema::dropIfExists('surat_masuks');
    }
}

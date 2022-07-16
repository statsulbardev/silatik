<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id');
            $table->string('tautan');
            $table->char('status_periksa')->default('bp');
            $table->timestamp('tanggal_buat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berkas_surats');
    }
}

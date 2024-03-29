<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitFungsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_fungsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent');
            $table->string('nama');
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
        Schema::dropIfExists('unit_fungsi');
    }
}

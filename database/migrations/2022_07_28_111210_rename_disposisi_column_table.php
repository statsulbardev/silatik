<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDisposisiColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disposisi', function(Blueprint $table) {
            $table->renameColumn('unit_fungsi_penerima', 'unit_fungsi_koordinasi');
            $table->renameColumn('catatan', 'catatan_kepala');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disposisi', function(Blueprint $table) {
            $table->renameColumn('unit_fungsi_koordinasi', 'unit_fungsi_penerima');
            $table->renameColumn('catatan_kepala', 'catatan');
        });
    }
}

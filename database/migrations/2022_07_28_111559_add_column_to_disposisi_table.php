<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disposisi', function (Blueprint $table) {
            $table->json('unit_fungsi_koordinasi')->nullable()->after('unit_fungsi_penerima');
            $table->json('unit_fungsi_teknis')->nullable()->after('unit_fungsi_koordinasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disposisi', function (Blueprint $table) {
            $table->dropColumn('unit_fungsi_koordinasi');
            $table->dropColumn('unit_fungsi_teknis');
        });
    }
}

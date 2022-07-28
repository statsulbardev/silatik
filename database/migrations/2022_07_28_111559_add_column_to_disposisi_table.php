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
            $table->timestamp('tgl_disposisi_koordinasi')->nullable()->after('catatan_kepala');
            $table->json('unit_fungsi_teknis')->nullable()->after('tgl_disposisi_koordinasi');
            $table->timestamp('tgl_disposisi_teknis')->nullable()->after('unit_fungsi_teknis');
            $table->text('catatan_kf')->nullable()->after('tgl_disposisi_teknis');
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
            $table->dropColumn('tgl_disposisi_koordinasi');
            $table->dropColumn('unit_fungsi_teknis');
            $table->dropColumn('tgl_disposisi_teknis');
            $table->dropColumn('catatan_kf');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('karyawan_detail_asset', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->comment('1 = dipinjam, 2 = dikembalikan');
        });
    }

    public function down()
    {
        Schema::table('karyawan_detail_asset', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

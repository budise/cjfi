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
        Schema::table('detail_assets', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->after('nilai_perolehan'); // 1 = di gudang, 2 = dipinjam
        });
    }

    public function down()
    {
        Schema::table('detail_assets', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengembalian_assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_detail_asset_id');
            $table->date('tanggal_kembali');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('karyawan_detail_asset_id')->references('id')->on('karyawan_detail_asset')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_assets');
    }
};

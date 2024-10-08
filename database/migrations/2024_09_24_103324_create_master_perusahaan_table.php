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
        Schema::create('master_perusahaan', function (Blueprint $table) {
            $table->bigIncrements('id_master_perusahaan');
            $table->integer('user_id');
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('nomor_telepon_perusahaan');
            $table->string('jenis_perusahaan');
            $table->string('nama_pic');
            $table->string('nomor_hp_pic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_perusahaan');
    }
};

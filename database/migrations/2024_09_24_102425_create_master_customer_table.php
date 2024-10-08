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
        Schema::create('master_customer', function (Blueprint $table) {
            $table->id();
            $table->string('kode_customer')->unique();
            $table->string('nama_toko');
            $table->text('alamat_toko');
            $table->enum('alamat_pengiriman', ['alamat_toko', 'alamat_lainnya']);
            $table->text('alamat_lainnya')->nullable();
            $table->string('nama_pemilik');
            $table->string('no_telepon')->unique();
            $table->enum('top', ['Cash', 'Kredit 7 Hari', 'Kredit 12 Hari', 'Kredit 30 Hari']);
            $table->integer('limit_kredit')->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->string('foto_toko');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_customer');
    }
};

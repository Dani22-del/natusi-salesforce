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
        Schema::create('master_stock', function (Blueprint $table) {
            $table->bigIncrements('id_master_stock');
            $table->unsignedBigInteger('produk_id');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_stock');
    }
};

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
        Schema::create('master_piutang', function (Blueprint $table) {
            $table->bigIncrements('id_piutang');
            $table->integer('customer_id');
            $table->string('kode_customer');
            $table->string('nama_toko');
            $table->integer('sales_id');
            $table->string('kode_sales');
            $table->integer('so_id');
            $table->string('no_invoice');
            $table->date('tanggal_invoice');
            $table->date('due_date');
            $table->decimal('total_invoice', 15, 2);
            $table->decimal('jumlah_bayar', 15, 2);
            $table->decimal('sisa_piutang', 15, 2);
            $table->string('status')->default('Belum');
            $table->boolean('is_delete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_piutang');
    }
};

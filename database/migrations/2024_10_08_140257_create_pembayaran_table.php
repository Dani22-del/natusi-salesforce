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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');
            $table->integer('piutang_id');
            $table->integer('customer_id');
            $table->integer('sales_id');
            $table->string('no_kwitansi');
            $table->date('tanggal_bayar');
            $table->string('metode_bayar');
            $table->date('due_date');
            $table->text('keterangan')->nullable();
            $table->float('jumlah_bayar', 10, 2);
            $table->text('tanda_tangan')->nullable();
            $table->text('status_approve')->nullable();
            $table->date('tanggal_approve');
            $table->text('status_pembayaran');
            $table->integer('is_delete_pembayaran')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

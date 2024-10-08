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
        Schema::create('master_so', function (Blueprint $table) {
            $table->id();
            $table->string('kode_so');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('sales_id');
            $table->string('kode_sales');
            $table->unsignedBigInteger('customer_id');
            $table->string('kode_customer');
            $table->string('no_invoice');
            $table->date('tanggal_invoice');
            $table->decimal('total_invoice', 15, 2);
            $table->text('catatan')->nullable();
            $table->enum('top', ['Cash', 'Kredit 7 Hari', 'Kredit 12 Hari', 'Kredit 30 Hari']);
            $table->decimal('limit_kredit', 15, 2);
            $table->text('tanda_tangan')->nullable();
            $table->string('status_order');
            $table->text('alasan_tdk_order')->nullable();
            $table->enum('status_approve', ['Pending', 'Ditolak', 'Dikirim']);
            $table->string('dipesan_oleh');
            $table->unsignedBigInteger('driver_id');
            $table->string('kode_driver');
            $table->string('status_pengiriman')->default('Belum');
            $table->string('foto_stok')->nullable();
            $table->string('alasan_lain')->nullable();
            $table->boolean('is_delete')->default(false);
            $table->timestamps();

            // // Foreign key constraints
            // $table->foreign('schedule_id')->references('id')->on('schedules');
            // $table->foreign('sales_id')->references('id')->on('sales');
            // $table->foreign('customer_id')->references('id')->on('customers');
            // $table->foreign('driver_id')->references('id')->on('drivers');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_so');
    }
};

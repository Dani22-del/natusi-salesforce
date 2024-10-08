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
        Schema::create('master_schedule_driver', function (Blueprint $table) {
            $table->bigIncrements('id_schedule_driver');
            $table->date('tanggal');
            $table->integer('driver_id');
            $table->integer('customer_id');
            $table->integer('so_id');
            $table->enum('status_kunjung',['Belum','Sudah']);
            $table->string('penerima')->nullable();
            $table->text('tanda_tangan')->nullable();
            $table->string('alasan_reschedule')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_schedule_driver');
    }
};

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
        Schema::create('master_schedule_sales', function (Blueprint $table) {
            $table->bigIncrements('id_schedule_sales');
            $table->date('tanggal');
            $table->integer('sales_id');
            $table->integer('customer_id');
            $table->enum('jenis',['Day','Week']);
            $table->enum('status_kunjung',['Belum','Sudah']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_schedule_sales');
    }
};

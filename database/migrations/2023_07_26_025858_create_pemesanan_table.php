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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pemesanan');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paket_id')->constrained('paket')->onDelete('cascade');
            $table->longText('address');
            $table->integer('jumlah');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->bigInteger('total_price');
            $table->enum('tipe_pickup', ['kurir', 'mandiri'])->default('mandiri');
            $table->bigInteger('harga_kurir')->default(0);
            $table->enum('status', ['waiting', 'process', 'pending', 'pickup', 'finished', 'cancelled'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};

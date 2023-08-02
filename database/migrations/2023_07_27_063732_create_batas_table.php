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
        Schema::create('batas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('batas')->default(40);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropColumn('tanggal_mulai');
            $table->dropColumn('tanggal_selesai');
            $table->foreignId('batas_id')->constrained('batas')->after('paket_id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batas');

        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropColumn('batas_id');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();

            // 🔥 relasi ke peminjaman
            $table->unsignedBigInteger('peminjaman_id');

            $table->date('tanggal_kembali');
            $table->integer('denda')->default(0);
            $table->string('status')->default('menunggu'); // menunggu / selesai

            $table->timestamps();

            // 🔥 foreign key (optional tapi disarankan)
            $table->foreign('peminjaman_id')
                  ->references('id')
                  ->on('peminjaman')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
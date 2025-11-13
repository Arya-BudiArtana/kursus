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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            // Sesuai permintaan: "Type Kendaraan"
            $table->string('type_kendaraan'); // Misal: "Toyota Avanza", "Honda Vario 150"
            // Kolom penting untuk kendaraan
            $table->string('nomor_polisi')->unique(); // Misal: "DK 1234 AB"
            // Kolom pembeda Dinas / Pool
            $table->string('classification'); // 'dinas' atau 'pool'
            // Status ketersediaan
            $table->string('status')->default('available'); // 'available', 'in_use', 'maintenance'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};

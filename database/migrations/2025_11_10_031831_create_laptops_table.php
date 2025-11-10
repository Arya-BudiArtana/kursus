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
        Schema::create('laptops', function (Blueprint $table) {
        $table->id();
        $table->string('merk'); // Misal: "Dell", "HP", "Lenovo"
        $table->string('spesifikasi'); // Misal: "Core i5, 8GB RAM"
        $table->year('tahun_pengadaan'); // Misal: 2023
        $table->string('status')->default('tersedia'); // '1: available', '2: borrowed', '3: maintenance'
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};

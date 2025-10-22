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
          Schema::create('clases', function (Blueprint $table) {
        $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
        $table->tinyText('nombre_clase');
        $table->foreignId('id_maestro')->constrained('maestros')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};

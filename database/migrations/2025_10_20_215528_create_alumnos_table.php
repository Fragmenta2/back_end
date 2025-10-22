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
         Schema::create('alumnos', function (Blueprint $table) {
        $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
        $table->tinyText('codigo');
        $table->tinyText('nombre');
        $table->string('correo', 100)->unique();
        $table->date('fecha_nacimiento');
        $table->char('sexo', 2);
        $table->tinyText('carrera');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};

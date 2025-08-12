<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->integer('estudiante_documento'); // Coincide con estudiantes.documento
           $table->unsignedInteger('subgrupo_id');
            $table->date('fecha');
            $table->enum('estado', ['presente', 'ausente', 'justificado']);
            $table->timestamps();
            
            $table->foreign('subgrupo_id')->references('id')->on('subgrupos')->onDelete('cascade');
            $table->unique(['estudiante_documento', 'fecha']);
        });

        // Agrega la relación a estudiantes con SQL plano
        DB::statement('ALTER TABLE asistencias ADD CONSTRAINT fk_estudiante_documento FOREIGN KEY (estudiante_documento) REFERENCES estudiantes(documento) ON DELETE CASCADE');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};

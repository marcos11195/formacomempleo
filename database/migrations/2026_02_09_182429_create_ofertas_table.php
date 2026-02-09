<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idempresa')
                ->constrained('empresas')
                ->onDelete('cascade');

            $table->foreignId('idsector')
                ->constrained('sectores');

            $table->foreignId('idmodalidad')
                ->constrained('modalidad');

            $table->foreignId('idpuesto')
                ->constrained('puestos')
                ->onDelete('cascade');

            $table->string('titulo', 200);
            $table->text('descripcion');
            $table->text('requisitos')->nullable();
            $table->text('funciones')->nullable();
            $table->decimal('salario_min', 10, 2)->nullable();
            $table->decimal('salario_max', 10, 2)->nullable();
            $table->string('tipo_contrato', 100)->nullable();
            $table->string('jornada', 100)->nullable();
            $table->string('ubicacion', 150)->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->date('publicar_hasta')->nullable();
            $table->date('fecha_incorporacion')->nullable();
            $table->enum('estado', ['borrador','publicada','pausada','cerrada','vencida'])
                  ->default('borrador');

            $table->timestamps();
            $table->softDeletes();

            $table->index('idempresa', 'idx_ofertas_empresa');
            $table->index('idsector', 'idx_ofertas_sector');
            $table->index('estado', 'idx_ofertas_estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};

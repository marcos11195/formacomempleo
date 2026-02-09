<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ofertas_candidatos', function (Blueprint $table) {
            $table->foreignId('idoferta')
                ->constrained('ofertas')
                ->onDelete('cascade');

            $table->foreignId('idcandidato')
                ->constrained('candidatos')
                ->onDelete('cascade');

            $table->timestamp('fecha_inscripcion')->useCurrent();
            $table->enum('estado', [
                'inscrito','revisado','preseleccionado','entrevista',
                'descartado','finalista','contratado'
            ])->default('inscrito');

            $table->text('comentarios')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->primary(['idoferta', 'idcandidato']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ofertas_candidatos');
    }
};

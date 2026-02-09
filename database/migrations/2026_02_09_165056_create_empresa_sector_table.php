<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresa_sector', function (Blueprint $table) {
            $table->unsignedBigInteger('idempresa');
            $table->unsignedBigInteger('idsector');

            $table->primary(['idempresa', 'idsector']);

            $table->foreign('idempresa')
                ->references('id')->on('empresas')
                ->onDelete('cascade');

            $table->foreign('idsector')
                ->references('id')->on('sectores')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresa_sector');
    }
};

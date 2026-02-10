<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->foreignId('candidato_id')
              ->nullable()
              ->constrained('candidatos')
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['candidato_id']);
        $table->dropColumn('candidato_id');
    });
}


    /**
     * Reverse the migrations.
     */
  
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('locais_estoque', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('codigo')->unique();
      $table->string('nome');
      $table->string('fuso')->default('America/Sao_Paulo');
      $table->ulid('endereco_id')->nullable();
      $table->timestamps();
    });

    Schema::create('itens_estoque', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('variante_id')->constrained('variantes_produto')->cascadeOnDelete();
      $table->foreignUlid('local_id')->constrained('locais_estoque')->cascadeOnDelete();
      $table->integer('saldo')->default(0);
      $table->integer('reservado')->default(0);
      $table->integer('estoque_seguranca')->default(0);
      $table->boolean('permite_backorder')->default(false);
      $table->timestamps();
      $table->unique(['variante_id','local_id']);
    });

    Schema::create('movimentos_estoque', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('item_estoque_id')->constrained('itens_estoque')->cascadeOnDelete();
      $table->string('tipo', 16); // TipoMovimentoEstoque
      $table->integer('quantidade');
      $table->ulid('ref_id')->nullable();
      $table->string('ref_tipo')->nullable();
      $table->timestamps();
      $table->index(['item_estoque_id','tipo']);
    });
  }

  public function down(): void {
    Schema::dropIfExists('movimentos_estoque');
    Schema::dropIfExists('itens_estoque');
    Schema::dropIfExists('locais_estoque');
  }
};

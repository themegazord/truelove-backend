<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('promocoes', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('nome');
      $table->string('tipo', 16)->default('cupom');          // TipoPromocao
      $table->string('tipo_valor', 16)->default('percentual');// TipoValorPromocao
      $table->decimal('valor', 12, 4)->default(0);
      $table->decimal('max_desconto', 12, 2)->nullable();
      $table->decimal('min_subtotal', 12, 2)->nullable();
      $table->timestampTz('inicia_em')->nullable();
      $table->timestampTz('termina_em')->nullable();
      $table->integer('limite_uso')->nullable();
      $table->integer('limite_por_cliente')->nullable();
      $table->boolean('ativo')->default(true);
      $table->timestamps();
    });

    Schema::create('cupons_promocao', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('promocao_id')->constrained('promocoes')->cascadeOnDelete();
      $table->string('codigo')->unique();
      $table->integer('usado_qtd')->default(0);
      $table->timestamps();
    });

    Schema::create('promocao_produto', function (Blueprint $table) {
      $table->foreignUlid('promocao_id')->constrained('promocoes')->cascadeOnDelete();
      $table->foreignUlid('produto_id')->constrained('produtos')->cascadeOnDelete();
      $table->primary(['promocao_id','produto_id']);
    });

    Schema::create('promocao_colecao', function (Blueprint $table) {
      $table->foreignUlid('promocao_id')->constrained('promocoes')->cascadeOnDelete();
      $table->foreignUlid('colecao_id')->constrained('colecoes')->cascadeOnDelete();
      $table->primary(['promocao_id','colecao_id']);
    });

    Schema::create('avaliacoes', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('produto_id')->constrained('produtos')->cascadeOnDelete();
      $table->foreignUlid('cliente_id')->constrained('perfis_clientes')->cascadeOnDelete();
      $table->unsignedTinyInteger('nota'); // 1..5
      $table->string('titulo')->nullable();
      $table->text('corpo')->nullable();
      $table->string('status', 16)->default('pendente'); // StatusAvaliacao
      $table->timestamps();
      $table->index(['produto_id','status']);
    });
  }

  public function down(): void {
    Schema::dropIfExists('avaliacoes');
    Schema::dropIfExists('promocao_colecao');
    Schema::dropIfExists('promocao_produto');
    Schema::dropIfExists('cupons_promocao');
    Schema::dropIfExists('promocoes');
  }
};

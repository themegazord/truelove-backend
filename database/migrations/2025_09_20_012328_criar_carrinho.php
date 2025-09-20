<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('carrinhos', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('cliente_id')->nullable()->constrained('perfis_clientes')->nullOnDelete();
      $table->string('sessao_token')->unique()->nullable();
      $table->char('moeda',3)->default('BRL');
      $table->timestampTz('expira_em')->nullable();
      $table->timestamps();
    });

    Schema::create('itens_carrinho', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('carrinho_id')->constrained('carrinhos')->cascadeOnDelete();
      $table->foreignUlid('variante_id')->constrained('variantes_produto');
      $table->integer('quantidade');
      $table->decimal('preco_snapshot', 12, 2);
      $table->json('descontos')->nullable();
      $table->timestamps();
      $table->index(['carrinho_id']);
    });
  }

  public function down(): void {
    Schema::dropIfExists('itens_carrinho');
    Schema::dropIfExists('carrinhos');
  }
};

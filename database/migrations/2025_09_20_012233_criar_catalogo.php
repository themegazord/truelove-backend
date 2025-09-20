<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('produtos', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('slug')->unique();
      $table->string('titulo');
      $table->text('descricao')->nullable();
      $table->string('status', 16)->default('rascunho');    // StatusProduto
      $table->boolean('adulto')->default(true);
      $table->string('seo_titulo')->nullable();
      $table->string('seo_descricao')->nullable();
      $table->timestamps();
      $table->softDeletesDatetime('excluido_em');
    });

    Schema::create('variantes_produto', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('produto_id')->constrained('produtos')->cascadeOnDelete();
      $table->string('sku')->unique();
      $table->string('codigo_barras')->nullable();
      $table->string('titulo');
      $table->decimal('preco', 12, 2);
      $table->decimal('preco_comparacao', 12, 2)->nullable();
      $table->decimal('preco_custo', 12, 2)->nullable();
      $table->char('moeda', 3)->default('BRL');
      $table->float('peso_g')->nullable();
      $table->json('dimensoes')->nullable();
      $table->boolean('exige_envio')->default(true);
      $table->boolean('padrao')->default(false);
      $table->timestamps();
    });

    Schema::create('opcoes_produto', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('produto_id')->constrained('produtos')->cascadeOnDelete();
      $table->string('nome'); // ex.: Cor, Tamanho
      $table->timestamps();
    });

    Schema::create('valores_opcao', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('opcao_id')->constrained('opcoes_produto')->cascadeOnDelete();
      $table->string('valor'); // ex.: Vermelho, M
      $table->timestamps();
    });

    Schema::create('variante_valor_opcao', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('variante_id')->constrained('variantes_produto')->cascadeOnDelete();
      $table->foreignUlid('valor_opcao_id')->constrained('valores_opcao')->cascadeOnDelete();
      $table->unique(['variante_id','valor_opcao_id']);
    });

    Schema::create('midias', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('url');
      $table->string('alt')->nullable();
      $table->integer('largura')->nullable();
      $table->integer('altura')->nullable();
      $table->string('tipo', 16)->default('imagem'); // TipoMidia
      $table->timestamps();
    });

    Schema::create('produto_midia', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('produto_id')->constrained('produtos')->cascadeOnDelete();
      $table->foreignUlid('midia_id')->constrained('midias')->cascadeOnDelete();
      $table->integer('posicao')->default(0);
      $table->string('papel', 16)->default('galeria'); // galeria|thumb
      $table->unique(['produto_id','midia_id']);
    });

    Schema::create('categorias', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->ulid('pai_id')->nullable();
      $table->string('slug')->unique();
      $table->string('nome');
      $table->text('descricao')->nullable();
      $table->timestamps();
    });

    Schema::create('categoria_produto', function (Blueprint $table) {
      $table->foreignUlid('produto_id')->constrained('produtos')->cascadeOnDelete();
      $table->foreignUlid('categoria_id')->constrained('categorias')->cascadeOnDelete();
      $table->integer('posicao')->default(0);
      $table->primary(['produto_id','categoria_id']);
    });

    Schema::create('colecoes', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('handle')->unique();
      $table->string('nome');
      $table->string('tipo', 16)->default('manual'); // manual|smart
      $table->json('regras')->nullable();
      $table->text('descricao')->nullable();
      $table->timestamps();
    });

    Schema::create('colecao_produto', function (Blueprint $table) {
      $table->foreignUlid('produto_id')->constrained('produtos')->cascadeOnDelete();
      $table->foreignUlid('colecao_id')->constrained('colecoes')->cascadeOnDelete();
      $table->integer('posicao')->default(0);
      $table->primary(['produto_id','colecao_id']);
    });
  }

  public function down(): void {
    Schema::dropIfExists('colecao_produto');
    Schema::dropIfExists('colecoes');
    Schema::dropIfExists('categoria_produto');
    Schema::dropIfExists('categorias');
    Schema::dropIfExists('produto_midia');
    Schema::dropIfExists('midias');
    Schema::dropIfExists('variante_valor_opcao');
    Schema::dropIfExists('valores_opcao');
    Schema::dropIfExists('opcoes_produto');
    Schema::dropIfExists('variantes_produto');
    Schema::dropIfExists('produtos');
  }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('pedidos', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('numero')->unique();
      $table->foreignUlid('cliente_id')->nullable()->constrained('perfis_clientes')->nullOnDelete();
      $table->string('email');
      $table->char('moeda',3)->default('BRL');
      $table->decimal('subtotal', 12, 2)->default(0);
      $table->decimal('desconto_total', 12, 2)->default(0);
      $table->decimal('frete_total', 12, 2)->default(0);
      $table->decimal('imposto_total', 12, 2)->default(0);
      $table->decimal('total', 12, 2)->default(0);
      $table->string('status', 16)->default('criado');                   // StatusPedido
      $table->string('status_pagamento', 16)->default('pendente');       // StatusPagamento
      $table->string('status_atendimento', 16)->default('nao_atendido'); // StatusAtendimento
      $table->timestampTz('realizado_em')->nullable();
      $table->timestamps();
      $table->index(['created_at','cliente_id']);
    });

    Schema::create('enderecos_pedido', function (Blueprint $table) {
      $table->foreignUlid('pedido_id')->constrained('pedidos')->cascadeOnDelete();
      $table->string('tipo', 16); // TipoEndereco
      $table->string('nome')->nullable();
      $table->string('telefone')->nullable();
      $table->string('linha1');
      $table->string('linha2')->nullable();
      $table->string('cidade')->nullable();
      $table->string('estado')->nullable();
      $table->string('cep')->nullable();
      $table->string('pais',2)->default('BR');
      $table->primary(['pedido_id','tipo']);
    });

    Schema::create('itens_pedido', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('pedido_id')->constrained('pedidos')->cascadeOnDelete();
      $table->foreignUlid('variante_id')->nullable()->constrained('variantes_produto')->nullOnDelete();
      $table->string('produto_titulo');
      $table->string('variante_titulo')->nullable();
      $table->string('sku')->nullable();
      $table->integer('quantidade');
      $table->decimal('preco', 12, 2);
      $table->decimal('desconto_total', 12, 2)->default(0);
      $table->decimal('total_item', 12, 2);
      $table->timestamps();
      $table->index(['pedido_id']);
    });

    Schema::create('impostos_item', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('item_pedido_id')->constrained('itens_pedido')->cascadeOnDelete();
      $table->string('codigo');
      $table->decimal('aliquota', 8, 4);
      $table->decimal('valor', 12, 2);
      $table->timestamps();
    });

    Schema::create('descontos_pedido', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('pedido_id')->constrained('pedidos')->cascadeOnDelete();
      $table->string('tipo', 16);        // cupom|auto
      $table->string('codigo')->nullable();
      $table->string('tipo_valor', 16);  // percentual|fixo
      $table->decimal('valor', 12, 4);
      $table->decimal('montante', 12, 2);
      $table->timestamps();
    });

    Schema::create('eventos_pedido', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('pedido_id')->constrained('pedidos')->cascadeOnDelete();
      $table->string('tipo');
      $table->json('dados')->nullable();
      $table->timestamps();
      $table->index(['pedido_id','tipo']);
    });

    Schema::create('pagamentos', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('pedido_id')->constrained('pedidos')->cascadeOnDelete();
      $table->string('provedor');
      $table->string('intent_id');
      $table->string('status', 32)->default('pendente'); // StatusPagamento
      $table->decimal('valor', 12, 2);
      $table->timestampTz('autorizado_em')->nullable();
      $table->timestampTz('capturado_em')->nullable();
      $table->string('erro_codigo')->nullable();
      $table->string('erro_msg')->nullable();
      $table->timestamps();
    });

    Schema::create('reembolsos', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('pagamento_id')->constrained('pagamentos')->cascadeOnDelete();
      $table->decimal('valor', 12, 2);
      $table->string('motivo')->nullable();
      $table->string('status', 16)->default('pendente');
      $table->timestamps();
    });

    Schema::create('remessas', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('pedido_id')->constrained('pedidos')->cascadeOnDelete();
      $table->foreignUlid('local_origem_id')->constrained('locais_estoque');
      $table->string('transportadora')->nullable();
      $table->string('servico')->nullable();
      $table->string('rastreamento')->nullable();
      $table->string('status', 16)->default('pronto');
      $table->timestampTz('enviado_em')->nullable();
      $table->timestampTz('entregue_em')->nullable();
      $table->timestamps();
    });

    Schema::create('itens_remessa', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('remessa_id')->constrained('remessas')->cascadeOnDelete();
      $table->foreignUlid('item_pedido_id')->constrained('itens_pedido')->cascadeOnDelete();
      $table->integer('quantidade');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('itens_remessa');
    Schema::dropIfExists('remessas');
    Schema::dropIfExists('reembolsos');
    Schema::dropIfExists('pagamentos');
    Schema::dropIfExists('eventos_pedido');
    Schema::dropIfExists('descontos_pedido');
    Schema::dropIfExists('impostos_item');
    Schema::dropIfExists('itens_pedido');
    Schema::dropIfExists('enderecos_pedido');
    Schema::dropIfExists('pedidos');
  }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('perfis_clientes', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
      $table->string('telefone')->nullable();
      $table->date('nascimento')->nullable();
      $table->boolean('consentimento_marketing')->default(false);
      $table->ulid('endereco_padrao_id')->nullable(); // aponta para enderecos.id
      $table->timestamps();
    });

    Schema::create('enderecos', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('cliente_id')->constrained('perfis_clientes')->cascadeOnDelete();
      $table->string('rotulo')->nullable();
      $table->string('nome')->nullable();
      $table->string('telefone')->nullable();
      $table->string('linha1');
      $table->string('linha2')->nullable();
      $table->string('cidade')->nullable();
      $table->string('estado')->nullable();
      $table->string('cep')->nullable();
      $table->string('pais', 2)->default('BR');
      $table->boolean('padrao_envio')->default(false);
      $table->boolean('padrao_cobranca')->default(false);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('enderecos');
    Schema::dropIfExists('perfis_clientes');
  }
};

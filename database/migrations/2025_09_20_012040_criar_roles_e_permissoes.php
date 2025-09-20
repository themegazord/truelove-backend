<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('roles', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('nome')->unique();
      $table->string('descricao')->nullable();
      $table->timestamps();
    });

    Schema::create('permissoes', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('chave')->unique();
      $table->string('descricao')->nullable();
      $table->timestamps();
    });

    Schema::create('usuario_role', function (Blueprint $table) {
      $table->foreignUlid('usuario_id')->constrained('usuarios')->cascadeOnDelete();
      $table->foreignUlid('role_id')->constrained('roles')->cascadeOnDelete();
      $table->primary(['usuario_id', 'role_id']);
    });

    Schema::create('role_permissao', function (Blueprint $table) {
      $table->foreignUlid('role_id')->constrained('roles')->cascadeOnDelete();
      $table->foreignUlid('permissao_id')->constrained('permissoes')->cascadeOnDelete();
      $table->primary(['role_id', 'permissao_id']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('role_permissao');
    Schema::dropIfExists('usuario_role');
    Schema::dropIfExists('permissoes');
    Schema::dropIfExists('roles');
  }
};

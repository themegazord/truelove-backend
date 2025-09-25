<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('enderecos', function (Blueprint $table) {
      $table->dropForeign(['cliente_id']);
      $table->dropColumn('cliente_id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('enderecos', function (Blueprint $table) {
      $table->foreignUlid('cliente_id')->after('id')->nullable()->constrained('perfis_clientes')->cascadeOnDelete();
    });
  }
};

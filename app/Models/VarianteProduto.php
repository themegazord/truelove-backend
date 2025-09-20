<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VarianteProduto extends Model
{
  use HasUlids;

  protected $table = 'variantes_produto';
  protected $fillable = ['produto_id', 'sku', 'codigo_barras', 'titulo', 'preco', 'preco_comparacao', 'preco_custo', 'moeda', 'peso_g', 'dimensoes', 'exige_envio', 'padrao'];
  protected $casts = ['preco' => 'decimal:2', 'preco_comparacao' => 'decimal:2', 'preco_custo' => 'decimal:2', 'exige_envio' => 'bool', 'padrao' => 'bool', 'dimensoes' => 'array'];

  public function produto(): BelongsTo
  {
    return $this->belongsTo(Produto::class, 'produto_id');
  }

  public function itensEstoque(): HasMany
  {
    return $this->hasMany(ItemEstoque::class, 'variante_id');
  }
}

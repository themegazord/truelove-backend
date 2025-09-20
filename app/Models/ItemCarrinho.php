<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemCarrinho extends Model
{
  use HasUlids;

  protected $table = 'itens_carrinho';
  protected $fillable = ['carrinho_id', 'variante_id', 'quantidade', 'preco_snapshot', 'descontos'];
  protected $casts = ['preco_snapshot' => 'decimal:2', 'descontos' => 'array'];

  public function carrinho(): BelongsTo
  {
    return $this->belongsTo(Carrinho::class, 'carrinho_id');
  }

  public function variante(): BelongsTo
  {
    return $this->belongsTo(VarianteProduto::class, 'variante_id');
  }
}

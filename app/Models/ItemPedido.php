<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemPedido extends Model
{
  use HasUlids;

  protected $table = 'itens_pedido';
  protected $fillable = ['pedido_id', 'variante_id', 'produto_titulo', 'variante_titulo', 'sku', 'quantidade', 'preco', 'desconto_total', 'total_item'];
  protected $casts = ['preco' => 'decimal:2', 'desconto_total' => 'decimal:2', 'total_item' => 'decimal:2'];

  public function pedido(): BelongsTo
  {
    return $this->belongsTo(Pedido::class, 'pedido_id');
  }

  public function variante(): BelongsTo
  {
    return $this->belongsTo(VarianteProduto::class, 'variante_id');
  }

  public function impostos(): HasMany
  {
    return $this->hasMany(ImpostoItem::class, 'item_pedido_id');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImpostoItem extends Model
{
  use HasUlids;

  protected $table = 'impostos_item';
  protected $fillable = ['item_pedido_id', 'codigo', 'aliquota', 'valor'];
  protected $casts = ['aliquota' => 'decimal:4', 'valor' => 'decimal:2'];

  public function item(): BelongsTo
  {
    return $this->belongsTo(ItemPedido::class, 'item_pedido_id');
  }
}

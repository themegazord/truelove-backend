<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemRemessa extends Model
{
  use HasUlids;

  protected $table = 'itens_remessa';
  protected $fillable = ['remessa_id', 'item_pedido_id', 'quantidade'];

  public function remessa(): BelongsTo
  {
    return $this->belongsTo(Remessa::class, 'remessa_id');
  }

  public function itemPedido(): BelongsTo
  {
    return $this->belongsTo(ItemPedido::class, 'item_pedido_id');
  }
}

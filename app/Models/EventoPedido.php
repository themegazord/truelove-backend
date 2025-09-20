<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventoPedido extends Model
{
  use HasUlids;

  protected $table = 'eventos_pedido';
  protected $fillable = ['pedido_id', 'tipo', 'dados'];
  protected $casts = ['dados' => 'array'];

  public function pedido(): BelongsTo
  {
    return $this->belongsTo(Pedido::class, 'pedido_id');
  }
}

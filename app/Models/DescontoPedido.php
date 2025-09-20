<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DescontoPedido extends Model
{
  use HasUlids;

  protected $table = 'descontos_pedido';
  protected $fillable = ['pedido_id', 'tipo', 'codigo', 'tipo_valor', 'valor', 'montante'];
  protected $casts = ['valor' => 'decimal:4', 'montante' => 'decimal:2'];

  public function pedido(): BelongsTo
  {
    return $this->belongsTo(Pedido::class, 'pedido_id');
  }
}

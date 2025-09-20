<?php

namespace App\Models;

use App\Enums\StatusPedido;
use App\Enums\StatusPagamento;
use App\Enums\StatusAtendimento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
  use HasUlids;

  protected $table = 'pedidos';
  protected $fillable = ['numero', 'cliente_id', 'email', 'moeda', 'subtotal', 'desconto_total', 'frete_total', 'imposto_total', 'total', 'status', 'status_pagamento', 'status_atendimento', 'realizado_em'];
  protected $casts = [
    'subtotal' => 'decimal:2', 'desconto_total' => 'decimal:2', 'frete_total' => 'decimal:2', 'imposto_total' => 'decimal:2', 'total' => 'decimal:2',
    'status' => StatusPedido::class, 'status_pagamento' => StatusPagamento::class, 'status_atendimento' => StatusAtendimento::class,
    'realizado_em' => 'datetime'
  ];

  public function cliente(): BelongsTo
  {
    return $this->belongsTo(PerfilCliente::class, 'cliente_id');
  }

  public function itens(): HasMany
  {
    return $this->hasMany(ItemPedido::class, 'pedido_id');
  }

  public function pagamentos(): HasMany
  {
    return $this->hasMany(Pagamento::class, 'pedido_id');
  }

  public function eventos(): HasMany
  {
    return $this->hasMany(EventoPedido::class, 'pedido_id');
  }
}

<?php

namespace App\Models;

use App\Enums\StatusPagamento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pagamento extends Model
{
  use HasUlids;

  protected $table = 'pagamentos';
  protected $fillable = ['pedido_id', 'provedor', 'intent_id', 'status', 'valor', 'autorizado_em', 'capturado_em', 'erro_codigo', 'erro_msg'];
  protected $casts = ['status' => StatusPagamento::class, 'valor' => 'decimal:2', 'autorizado_em' => 'datetime', 'capturado_em' => 'datetime'];

  public function pedido(): BelongsTo
  {
    return $this->belongsTo(Pedido::class, 'pedido_id');
  }

  public function reembolsos(): HasMany
  {
    return $this->hasMany(Reembolso::class, 'pagamento_id');
  }
}

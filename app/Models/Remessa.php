<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Remessa extends Model
{
  use HasUlids;

  protected $table = 'remessas';
  protected $fillable = ['pedido_id', 'local_origem_id', 'transportadora', 'servico', 'rastreamento', 'status', 'enviado_em', 'entregue_em'];
  protected $casts = ['enviado_em' => 'datetime', 'entregue_em' => 'datetime'];

  public function pedido(): BelongsTo
  {
    return $this->belongsTo(Pedido::class, 'pedido_id');
  }

  public function localOrigem(): BelongsTo
  {
    return $this->belongsTo(LocalEstoque::class, 'local_origem_id');
  }

  public function itens(): HasMany
  {
    return $this->hasMany(ItemRemessa::class, 'remessa_id');
  }
}

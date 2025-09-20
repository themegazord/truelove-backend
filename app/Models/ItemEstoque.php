<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemEstoque extends Model
{
  use HasUlids;

  protected $table = 'itens_estoque';
  protected $fillable = ['variante_id', 'local_id', 'saldo', 'reservado', 'estoque_seguranca', 'permite_backorder'];
  protected $casts = ['permite_backorder' => 'bool'];

  public function variante(): BelongsTo
  {
    return $this->belongsTo(VarianteProduto::class, 'variante_id');
  }

  public function local(): BelongsTo
  {
    return $this->belongsTo(LocalEstoque::class, 'local_id');
  }

  public function movimentos(): HasMany
  {
    return $this->hasMany(MovimentoEstoque::class, 'item_estoque_id');
  }
}

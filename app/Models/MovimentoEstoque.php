<?php

namespace App\Models;

use App\Enums\TipoMovimentoEstoque;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimentoEstoque extends Model
{
  use HasUlids;

  protected $table = 'movimentos_estoque';
  protected $fillable = ['item_estoque_id', 'tipo', 'quantidade', 'ref_id', 'ref_tipo'];
  protected $casts = ['tipo' => TipoMovimentoEstoque::class];

  public function item(): BelongsTo
  {
    return $this->belongsTo(ItemEstoque::class, 'item_estoque_id');
  }
}

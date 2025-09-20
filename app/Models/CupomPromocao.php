<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CupomPromocao extends Model
{
  use HasUlids;

  protected $table = 'cupons_promocao';
  protected $fillable = ['promocao_id', 'codigo', 'usado_qtd'];

  public function promocao(): BelongsTo
  {
    return $this->belongsTo(Promocao::class, 'promocao_id');
  }
}

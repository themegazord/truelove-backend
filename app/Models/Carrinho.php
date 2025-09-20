<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrinho extends Model
{
  use HasUlids;

  protected $table = 'carrinhos';
  protected $fillable = ['cliente_id', 'sessao_token', 'moeda', 'expira_em'];
  protected $casts = ['expira_em' => 'datetime'];

  public function cliente(): BelongsTo
  {
    return $this->belongsTo(PerfilCliente::class, 'cliente_id');
  }

  public function itens(): HasMany
  {
    return $this->hasMany(ItemCarrinho::class, 'carrinho_id');
  }
}

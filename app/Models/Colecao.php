<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Colecao extends Model
{
  use HasUlids;

  protected $table = 'colecoes';
  protected $fillable = ['handle', 'nome', 'tipo', 'regras', 'descricao'];
  protected $casts = ['regras' => 'array'];

  public function produtos(): BelongsToMany
  {
    return $this->belongsToMany(Produto::class, 'colecao_produto');
  }
}

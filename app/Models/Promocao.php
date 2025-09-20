<?php

namespace App\Models;

use App\Enums\TipoPromocao;
use App\Enums\TipoValorPromocao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promocao extends Model
{
  use HasUlids;

  protected $table = 'promocoes';
  protected $fillable = ['nome', 'tipo', 'tipo_valor', 'valor', 'max_desconto', 'min_subtotal', 'inicia_em', 'termina_em', 'limite_uso', 'limite_por_cliente', 'ativo'];
  protected $casts = ['tipo' => TipoPromocao::class, 'tipo_valor' => TipoValorPromocao::class, 'valor' => 'decimal:4', 'max_desconto' => 'decimal:2', 'min_subtotal' => 'decimal:2', 'inicia_em' => 'datetime', 'termina_em' => 'datetime', 'ativo' => 'bool'];

  public function produtos(): BelongsToMany
  {
    return $this->belongsToMany(Produto::class, 'promocao_produto', 'promocao_id', 'produto_id');
  }

  public function colecoes(): BelongsToMany
  {
    return $this->belongsToMany(Colecao::class, 'promocao_colecao', 'promocao_id', 'colecao_id');
  }
}

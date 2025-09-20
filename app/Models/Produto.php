<?php

namespace App\Models;

use App\Enums\StatusProduto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
  use HasUlids, SoftDeletes;

  protected $table = 'produtos';
  protected $fillable = ['slug', 'titulo', 'descricao', 'status', 'adulto', 'seo_titulo', 'seo_descricao'];
  protected $casts = ['status' => StatusProduto::class, 'adulto' => 'bool', 'excluido_em' => 'datetime'];

  public function variantes(): HasMany
  {
    return $this->hasMany(VarianteProduto::class, 'produto_id');
  }

  public function categorias(): BelongsToMany
  {
    return $this->belongsToMany(Categoria::class, 'categoria_produto');
  }

  public function colecoes(): BelongsToMany
  {
    return $this->belongsToMany(Colecao::class, 'colecao_produto');
  }

  public function midias(): BelongsToMany
  {
    return $this->belongsToMany(Midia::class, 'produto_midia', 'produto_id', 'midia_id')->withPivot(['posicao', 'papel']);
  }
}

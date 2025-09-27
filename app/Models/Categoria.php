<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categoria extends Model
{
  use HasUlids;

  protected $table = 'categorias';
  protected $fillable = ['pai_id', 'slug', 'nome', 'descricao', 'metadata'];

  public function produtos(): BelongsToMany
  {
    return $this->belongsToMany(Produto::class, 'categoria_produto');
  }
}

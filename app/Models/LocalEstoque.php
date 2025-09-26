<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LocalEstoque extends Model
{
  use HasUlids, HasFactory;

  protected $table = 'locais_estoque';
  protected $fillable = ['codigo', 'nome', 'fuso', 'endereco_id'];

  public function itens(): HasMany
  {
    return $this->hasMany(ItemEstoque::class, 'local_id');
  }

  public function endereco(): BelongsTo
  {
    // FK na tabela locais_estoque
    return $this->belongsTo(Endereco::class, 'endereco_id', 'id');
  }
}

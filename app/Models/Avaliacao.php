<?php

namespace App\Models;

use App\Enums\StatusAvaliacao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avaliacao extends Model
{
  use HasUlids;

  protected $table = 'avaliacoes';
  protected $fillable = ['produto_id', 'cliente_id', 'nota', 'titulo', 'corpo', 'status'];
  protected $casts = ['nota' => 'integer', 'status' => StatusAvaliacao::class];

  public function produto(): BelongsTo
  {
    return $this->belongsTo(Produto::class, 'produto_id');
  }

  public function cliente(): BelongsTo
  {
    return $this->belongsTo(PerfilCliente::class, 'cliente_id');
  }
}

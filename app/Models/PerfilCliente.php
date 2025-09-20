<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerfilCliente extends Model
{
  use HasUlids;

  protected $table = 'perfis_clientes';
  protected $fillable = ['user_id', 'cpf', 'telefone', 'nascimento', 'consentimento_marketing', 'endereco_padrao_id'];
  protected $casts = ['consentimento_marketing' => 'bool', 'nascimento' => 'date'];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function enderecos(): HasMany
  {
    return $this->hasMany(Endereco::class, 'cliente_id');
  }
}

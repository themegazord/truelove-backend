<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Endereco extends Model
{
  use HasUlids;

  protected $table = 'enderecos';
  protected $fillable = ['rotulo', 'nome', 'telefone', 'logradouro', 'bairro', 'numero', 'complemento', 'cidade', 'estado', 'cep', 'pais', 'padrao_envio', 'padrao_cobranca'];
  protected $casts = ['padrao_envio' => 'bool', 'padrao_cobranca' => 'bool'];

  public function locaisEstoque(): HasMany // se for 1:1 pode usar HasOne
  {
    // FK na tabela locais_estoque
    return $this->hasMany(LocalEstoque::class, 'endereco_id', 'id');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permissao extends Model
{
  use HasUlids;

  protected $table = 'permissoes';
  protected $fillable = ['chave', 'descricao'];

  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(Role::class, 'role_permissao');
  }
}

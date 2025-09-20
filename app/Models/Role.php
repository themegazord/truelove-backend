<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
  use HasUlids;

  protected $table = 'roles';
  protected $fillable = ['nome', 'descricao'];

  public function usuarios(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'usuario_role');
  }

  public function permissoes(): BelongsToMany
  {
    return $this->belongsToMany(Permissao::class, 'role_permissao');
  }
}

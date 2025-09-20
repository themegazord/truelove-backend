<?php

namespace App\Models;

use App\Enums\TipoMidia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Midia extends Model
{
  use HasUlids;

  protected $table = 'midias';
  protected $fillable = ['url', 'alt', 'largura', 'altura', 'tipo'];
  protected $casts = ['tipo' => TipoMidia::class];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reembolso extends Model
{
  use HasUlids;

  protected $table = 'reembolsos';
  protected $fillable = ['pagamento_id', 'valor', 'motivo', 'status'];
  protected $casts = ['valor' => 'decimal:2'];

  public function pagamento(): BelongsTo
  {
    return $this->belongsTo(Pagamento::class, 'pagamento_id');
  }
}

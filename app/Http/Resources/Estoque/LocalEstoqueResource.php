<?php

namespace App\Http\Resources\Estoque;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalEstoqueResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'nome' => $this->nome,
      'codigo' => $this->codigo,
      'fuso' => $this->fuso,
    ];
  }
}

<?php

namespace App\Service\Estoque\Categoria;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CadastroService
{
  /**
   * @throws Throwable
   */
  public function store(array $dados): Categoria {
    try {
      return DB::transaction(function () use ($dados) {
        return Categoria::query()->create([
          'nome' => $dados['nome'],
          'slug' => $dados['slug'],
        ]);
      });
    } catch (\Exception $e) {
      throw new \Exception('Problema ao cadastrar categoria. ' . $e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }
}

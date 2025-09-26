<?php

namespace App\Service\Estoque\LocalEstoque;

use App\Models\Endereco;
use App\Models\LocalEstoque;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CadastroService
{
  /**
   * @throws \Throwable
   */
  public function store(array $dados): LocalEstoque
  {
    try {
      return DB::transaction(function () use ($dados) {
        $local = LocalEstoque::query()->create([
          'nome' => $dados['nome'],
          'fuso' => $dados['fuso'],
          'codigo' => $dados['codigo'],
        ]);

        $endereco = Endereco::query()->create([
          'logradouro'   => $dados['endereco']['logradouro'] ?? null,
          'numero'       => $dados['endereco']['numero'] ?? null,
          'cidade'       => $dados['endereco']['cidade'] ?? null,
          'bairro'       => $dados['endereco']['bairro'] ?? null,
          'estado'       => $dados['endereco']['estado'] ?? null,
          'cep'          => $dados['endereco']['cep'] ?? null,
          'complemento'  => $dados['endereco']['complemento'] ?? null,
        ]);

        // 3) associa o endereço ao local e salva
        $local->endereco()->associate($endereco); // seta endereco_id
        $local->save();
        return $local->load('endereco');
      });
    } catch (\Exception $e) {
      throw new \Exception('Problema ao cadastrar registro local de estoque. ' . $e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }
}

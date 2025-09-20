<?php

namespace App\Service\Autenticacao;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CadastroService
{
  /**
   * @throws \Exception
   */
  public function cadastra(Collection $dados)
  {
    try {
      $perfil = DB::transaction(function () use ($dados) {
        $usuarioCadastro = User::query()->create([
          'name' => $dados->get('nome'),
          'email' => $dados->get('email'),
          'password' => Hash::make($dados->get('senha')),
          'ativo' => true,
        ]);

        $perfilCadastrado = $usuarioCadastro->perfil()->create([
          'telefone' => $dados->get('telefone'),
          'cpf' => $dados->get('cpf'),
          'nascimento' => $dados->get('nascimento'),
          'consentimento_marketing' => $dados->get('consentimento'),
        ]);


        $endereco = $dados->get('endereco', []);

        $perfilCadastrado->enderecos()->create([
          'logradouro' => $endereco['logradouro'] ?? null,
          'bairro' => $endereco['bairro'] ?? null,
          'numero' => $endereco['numero'] ?? null,
          'complemento' => $endereco['complemento'] ?? null,
          'cidade' => $endereco['cidade'] ?? null,
          'estado' => $endereco['uf'] ?? null, // se sua regra usa `endereco.uf`
          'cep' => $endereco['cep'] ?? null,
        ]);

        return $perfilCadastrado;

      });
    } catch (\Exception $e) {
      throw new \Exception("Aconteceu algum problema no cadastro do cliente, por favor, entrar em contato com suporte" . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    return $perfil->load('enderecos');
  }
}

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
          'name' => $dados->get('name'),
          'email' => $dados->get('email'),
          'password' => Hash::make($dados->get('password')),
          'ativo' => true,
        ]);

        $perfilCadastrado = $usuarioCadastro->perfil()->create([
          'telefone' => $dados->get('telefone'),
          'cpf' => $dados->get('cpf'),
          'nascimento' => $dados->get('data_nascimento'),
          'consentimento_marketing' => $dados->get('consentimento_marketing'),
        ]);

        $perfilCadastrado->enderecos()->createMany([
          'rotulo' => $dados->get('endereco_padrao.rotulo'),
          'nome' => $dados->get('endereco_padrao.nome'),
          'telefone' => $dados->get('endereco_padrao.telefone'),
          'linha1' => $dados->get('endereco_padrao.linha1'),
          'linha2' => $dados->get('endereco_padrao.linha2'),
          'cidade' => $dados->get('endereco_padrao.cidade'),
          'uf' => $dados->get('endereco_padrao.uf'),
          'cep' => $dados->get('endereco_padrao.cep'),
          'pais' => $dados->get('endereco_padrao.pais'),
          'padrao_envio' => $dados->get('endereco_padrao.padrao_envio'),
          'padrao_cobranca' => $dados->get('endereco_padrao.padrao_cobranca'),
        ]);

        return $perfilCadastrado;

      });
    } catch (\Exception $e) {
      throw new \Exception("Aconteceu algum problema no cadastro do cliente, por favor, entrar em contato com suporte", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    return $perfil->load('enderecos');
  }
}

<?php

namespace App\Http\Requests\Autenticacao;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'nome' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'senha' => 'required|string',
      'confirmarSenha' => 'required|string|same:senha',
      'telefone' => 'string|max:255',
      'nascimento' => 'date',
      'cpf' => 'required|string|size:11|unique:perfis_clientes',
      'consentimento' => 'boolean',
      'endereco.rotulo' => 'string|max:255',
      'endereco.nome' => 'string|max:255',
      'endereco.telefone' => 'string|max:255',
      'endereco.logradouro' => 'required|string|max:255',
      'endereco.bairro' => 'string|max:255',
      'endereco.numero' => 'string|max:255',
      'endereco.complemento' => 'nullable|string|max:255',
      'endereco.cidade' => 'string|max:255',
      'endereco.uf' => 'string|max:2',
      'endereco.cep' => 'required|string|size:8',
      'endereco.pais' => 'string|max:255',
      'endereco.padrao_envio' => 'boolean',
      'endereco.padrao_cobranca' => 'boolean',
    ];
  }

  public function messages(): array
  {
    return [
      'nome.required' => 'O :attribute é obrigatório.',
      'nome.string' => 'O :attribute deve ser um texto.',
      'nome.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'email.required' => 'O :attribute é obrigatório.',
      'email.string' => 'O :attribute deve ser um texto.',
      'email.email' => 'Informe um :attribute válido.',
      'email.max' => 'O :attribute não pode ultrapassar :max caracteres.',
      'email.unique' => 'Este :attribute já está em uso.',

      'senha.required' => 'A :attribute é obrigatória.',
      'senha.string' => 'A :attribute deve ser um texto.',

      'confirmarSenha.required' => 'A :attribute é obrigatória.',
      'confirmarSenha.string' => 'A :attribute deve ser um texto.',
      'confirmarSenha.same' => 'A :attribute deve corresponder à senha.',

      'telefone.string' => 'O :attribute deve ser um texto.',
      'telefone.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'nascimento.date' => 'A :attribute deve ser uma data válida.',

      'cpf.required' => 'O :attribute é obrigatório.',
      'cpf.string' => 'O :attribute deve ser um texto.',
      'cpf.size' => 'O :attribute deve ter exatamente :size dígitos.',
      'cpf.unique' => 'O :attribute já está em uso.',

      'consentimento.boolean' => 'O :attribute deve ser verdadeiro ou falso.',

      'endereco.rotulo.string' => 'O :attribute deve ser um texto.',
      'endereco.rotulo.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco.nome.string' => 'O :attribute deve ser um texto.',
      'endereco.nome.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco.telefone.string' => 'O :attribute deve ser um texto.',
      'endereco.telefone.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco.logradouro.required' => 'O campo :attribute é obrigatório.',
      'endereco.*.string' => 'O campo :attribute deve ser um texto.',
      'endereco.*.max' => 'O campo :attribute deve ter no máximo :max caracteres.',

      'endereco.cidade.string' => 'A :attribute deve ser um texto.',
      'endereco.cidade.max' => 'A :attribute não pode ultrapassar :max caracteres.',

      'endereco.uf.string' => 'O :attribute deve ser um texto.',
      'endereco.uf.max' => 'O :attribute deve ter no máximo :max caracteres.',

      'endereco.cep.required' => 'O :attribute é obrigatório.',
      'endereco.cep.string' => 'O :attribute deve ser um texto.',
      'endereco.cep.size' => 'O :attribute deve ter :size caracteres.',

      'endereco.pais.string' => 'O :attribute deve ser um texto.',
      'endereco.pais.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco.padrao_envio.boolean' => 'O :attribute deve ser verdadeiro ou falso.',
      'endereco.padrao_cobranca.boolean' => 'O :attribute deve ser verdadeiro ou falso.',
    ];
  }

  public function attributes(): array
  {
    return [
      'nome' => 'nome',
      'email' => 'e-mail',
      'senha' => 'senha',
      'confirmarSenha' => 'confirmação de senha',
      'telefone' => 'telefone',
      'nascimento' => 'data de nascimento',
      'cpf' => 'CPF',
      'consentimento' => 'consentimento de marketing',

      'endereco.rotulo' => 'rótulo do endereço',
      'endereco.nome' => 'nome do endereço',
      'endereco.telefone' => 'telefone do endereço',
      'endereco.logradouro' => 'endereço',
      'endereco.bairro' => 'bairro',
      'endereco.numero' => 'número',
      'endereco.complemento' => 'complemento',
      'endereco.cidade' => 'cidade do endereço',
      'endereco.uf' => 'estado (UF) do endereço',
      'endereco.cep' => 'CEP',
      'endereco.pais' => 'país do endereço',
      'endereco.padrao_envio' => 'padrão de envio',
      'endereco.padrao_cobranca' => 'padrão de cobrança',
    ];
  }
}

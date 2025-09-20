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
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string',
      'password_confirmation' => 'required|string|same:password',
      'telefone' => 'string|max:255',
      'nascimento' => 'date',
      'cpf' => 'required|string|max:11|exists:perfis_clientes',
      'consentimento_marketing' => 'boolean',
      'endereco_padrao.rotulo' => 'string|max:255',
      'endereco_padrao.nome' => 'string|max:255',
      'endereco_padrao.telefone' => 'string|max:255',
      'endereco_padrao.linha1' => 'required|string|max:255',
      'endereco_padrao.linha2' => 'string|max:255',
      'endereco_padrao.cidade' => 'string|max:255',
      'endereco_padrao.uf' => 'string|max:2',
      'endereco_padrao.cep' => 'required|string|max:8',
      'endereco_padrao.pais' => 'required|string|max:255',
      'endereco_padrao.padrao_envio' => 'boolean',
      'endereco_padrao.padrao_cobranca' => 'boolean',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'O :attribute é obrigatório.',
      'name.string' => 'O :attribute deve ser um texto.',
      'name.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'email.required' => 'O :attribute é obrigatório.',
      'email.string' => 'O :attribute deve ser um texto.',
      'email.email' => 'Informe um :attribute válido.',
      'email.max' => 'O :attribute não pode ultrapassar :max caracteres.',
      'email.unique' => 'Este :attribute já está em uso.',

      'password.required' => 'A :attribute é obrigatória.',
      'password.string' => 'A :attribute deve ser um texto.',

      'password_confirmation.required' => 'A :attribute é obrigatória.',
      'password_confirmation.string' => 'A :attribute deve ser um texto.',
      'password_confirmation.same' => 'A :attribute deve corresponder à senha.',

      'telefone.string' => 'O :attribute deve ser um texto.',
      'telefone.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'nascimento.date' => 'A :attribute deve ser uma data válida.',

      'consentimento_marketing.boolean' => 'O :attribute deve ser verdadeiro ou falso.',

      'endereco_padrao.rotulo.string' => 'O :attribute deve ser um texto.',
      'endereco_padrao.rotulo.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco_padrao.nome.string' => 'O :attribute deve ser um texto.',
      'endereco_padrao.nome.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco_padrao.telefone.string' => 'O :attribute deve ser um texto.',
      'endereco_padrao.telefone.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco_padrao.linha1.required' => 'A :attribute é obrigatória.',
      'endereco_padrao.linha1.string' => 'A :attribute deve ser um texto.',
      'endereco_padrao.linha1.max' => 'A :attribute não pode ultrapassar :max caracteres.',

      'endereco_padrao.linha2.string' => 'A :attribute deve ser um texto.',
      'endereco_padrao.linha2.max' => 'A :attribute não pode ultrapassar :max caracteres.',

      'endereco_padrao.cidade.string' => 'A :attribute deve ser um texto.',
      'endereco_padrao.cidade.max' => 'A :attribute não pode ultrapassar :max caracteres.',

      'endereco_padrao.uf.string' => 'O :attribute deve ser um texto.',
      'endereco_padrao.uf.max' => 'O :attribute deve ter no máximo :max caracteres.',

      'endereco_padrao.cep.required' => 'O :attribute é obrigatório.',
      'endereco_padrao.cep.string' => 'O :attribute deve ser um texto.',
      'endereco_padrao.cep.max' => 'O :attribute deve ter no máximo :max caracteres.',

      'endereco_padrao.pais.required' => 'O :attribute é obrigatório.',
      'endereco_padrao.pais.string' => 'O :attribute deve ser um texto.',
      'endereco_padrao.pais.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco_padrao.padrao_envio.boolean' => 'O :attribute deve ser verdadeiro ou falso.',
      'endereco_padrao.padrao_cobranca.boolean' => 'O :attribute deve ser verdadeiro ou falso.',
    ];
  }

  public function attributes(): array
  {
    return [
      'name' => 'nome',
      'email' => 'e-mail',
      'password' => 'senha',
      'password_confirmation' => 'confirmação de senha',
      'telefone' => 'telefone',
      'nascimento' => 'data de nascimento',
      'consentimento_marketing' => 'consentimento de marketing',

      'endereco_padrao.rotulo' => 'rótulo do endereço',
      'endereco_padrao.nome' => 'nome do endereço',
      'endereco_padrao.telefone' => 'telefone do endereço',
      'endereco_padrao.linha1' => 'linha 1 do endereço',
      'endereco_padrao.linha2' => 'linha 2 do endereço',
      'endereco_padrao.cidade' => 'cidade do endereço',
      'endereco_padrao.uf' => 'estado do endereço',
      'endereco_padrao.cep' => 'CEP',
      'endereco_padrao.pais' => 'país do endereço',
      'endereco_padrao.padrao_envio' => 'padrão de envio',
      'endereco_padrao.padrao_cobranca' => 'padrão de cobrança',
    ];
  }
}

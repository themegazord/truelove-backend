<?php

namespace App\Http\Requests\Autenticacao;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
      'email' => 'required|string|email|exists:users,email',
      'password' => 'required|string',
      'rememberMe' => 'boolean'
    ];
  }

  /**
   * Get custom messages for validator errors.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'email.required' => 'O :attribute é obrigatório.',
      'email.string'   => 'O :attribute deve ser um texto.',
      'email.email'    => 'Informe um :attribute válido.',
      'email.exists'   => 'Não encontramos um cadastro com este :attribute.',

      'password.required' => 'A :attribute é obrigatória.',
      'password.string'   => 'A :attribute deve ser um texto.',

      'rememberMe.boolean' => 'O :attribute deve ser verdadeiro ou falso.',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array<string, string>
   */
  public function attributes(): array
  {
    return [
      'email' => 'e-mail',
      'password' => 'senha',
      'rememberMe' => 'lembrar-me',
    ];
  }
}

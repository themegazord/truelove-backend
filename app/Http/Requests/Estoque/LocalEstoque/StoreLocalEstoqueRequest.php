<?php

namespace App\Http\Requests\Estoque\LocalEstoque;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLocalEstoqueRequest extends FormRequest
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
      'codigo' => 'required|string|max:20',
      'nome' => 'required|string|max:155',
      'fuso' => ['required', 'string', Rule::in(['America/Noronha', 'America/Sao_Paulo', 'America/Campo_Grande', 'America/Manaus', 'America/Rio_Branco'])],
      'endereco' => 'required',
      'endereco.cep' => 'required|string|size:8',
      'endereco.logradouro' => 'required|string|max:255',
      'endereco.bairro' => 'required|string|max:255',
      'endereco.cidade' => 'required|string|max:255',
      'endereco.estado' => 'required|string|size:2',
      'endereco.complemento' => 'nullable|string|max:255',
    ];
  }

  public function attributes(): array
  {
    return [
      'codigo' => 'código do local',
      'nome' => 'nome do local',
      'fuso' => 'fuso horário do local',
      'endereco' => 'endereço',
      'endereco.cep' => 'CEP',
      'endereco.logradouro' => 'logradouro',
      'endereco.bairro' => 'bairro',
      'endereco.cidade' => 'cidade',
      'endereco.estado' => 'estado',
      'endereco.complemento' => 'complemento',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'codigo.required' => 'O :attribute é obrigatório.',
      'codigo.string' => 'O :attribute deve ser um texto.',
      'codigo.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'nome.required' => 'O :attribute é obrigatório.',
      'nome.string' => 'O :attribute deve ser um texto.',
      'nome.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'fuso.required' => 'O :attribute é obrigatório.',
      'fuso.string' => 'O :attribute deve ser um texto.',
      'fuso.in' => 'O :attribute selecionado é inválido.',

      'endereco.required' => 'O :attribute é obrigatório.',

      'endereco.cep.required' => 'O :attribute é obrigatório.',
      'endereco.cep.string' => 'O :attribute deve ser um texto.',
      'endereco.cep.size' => 'O :attribute deve ter :size caracteres.',

      'endereco.logradouro.required' => 'O :attribute é obrigatório.',
      'endereco.logradouro.string' => 'O :attribute deve ser um texto.',
      'endereco.logradouro.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco.bairro.required' => 'O :attribute é obrigatório.',
      'endereco.bairro.string' => 'O :attribute deve ser um texto.',
      'endereco.bairro.max' => 'O :attribute não pode ultrapassar :max caracteres.',

      'endereco.cidade.required' => 'A :attribute é obrigatória.',
      'endereco.cidade.string' => 'A :attribute deve ser um texto.',
      'endereco.cidade.max' => 'A :attribute não pode ultrapassar :max caracteres.',

      'endereco.estado.required' => 'O :attribute é obrigatório.',
      'endereco.estado.string' => 'O :attribute deve ser um texto.',
      'endereco.estado.size' => 'O :attribute deve ter :size caracteres.',

      'endereco.complemento.string' => 'O :attribute deve ser um texto.',
      'endereco.complemento.max' => 'O :attribute não pode ultrapassar :max caracteres.',
    ];
  }
}

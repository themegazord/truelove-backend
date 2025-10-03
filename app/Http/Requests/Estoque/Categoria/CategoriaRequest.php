<?php

namespace App\Http\Requests\Estoque\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
      'nome' => 'required|string|max:155',
      'slug' => 'required|string|unique:categorias|max:155'
    ];
  }


  /**
   * Customiza as mensagens de validação.
   */
  public function messages(): array
  {
    return [
      'nome.required' => 'O nome é obrigatório.',
      'nome.string' => 'O nome deve ser um texto.',
      'nome.max' => 'O nome deve ter no máximo :max caracteres.',

      'slug.required' => 'O slug é obrigatório.',
      'slug.string' => 'O slug deve ser um texto.',
      'slug.unique' => 'Já existe uma categoria com este slug.',
      'slug.max' => 'O slug deve ter no máximo :max caracteres.',
    ];
  }

  /**
   * Define rótulos amigáveis para os atributos.
   */
  public function attributes(): array
  {
    return [
      'nome' => 'nome da categoria',
      'slug' => 'slug da categoria',
    ];
  }
}

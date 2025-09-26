<?php

namespace Database\Factories;

use App\Models\LocalEstoque;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LocalEstoque>
 */
class LocalEstoqueFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */

  protected $model = LocalEstoque::class;
  public function definition(): array
  {
    return [
      'id' => Str::ulid(),
      'nome' => $this->faker->name(),
      'codigo' => Str::ulid(),
      'fuso' => $this->faker->randomElement([
        'America/Noronha',
        'America/Sao_Paulo',
        'America/Campo_Grande',
        'America/Manaus',
        'America/Rio_Branco',
      ]),
      'endereco_id' => '01k61xchr7ejewjshevdkdknrj'
    ];
  }
}

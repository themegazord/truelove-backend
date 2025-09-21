<?php

namespace App\Service\Autenticacao;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class LoginService
{
  public function store(Collection $dados): bool
  {
    $response = false;
    if (Auth::attempt([
      'email' => $dados->get('email'),
      'password' => $dados->get('password'),
    ], $dados->get('rememberMe', false))) {
      $response = true;
    }

    return $response;
  }
}

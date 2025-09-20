<?php

namespace App\Http\Controllers\Autenticacao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Autenticacao\CadastroRequest;
use App\Service\Autenticacao\CadastroService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CadastroController extends Controller
{
  public function store(CadastroRequest $request, CadastroService $service)
  {
    try {
      $dados = $service->cadastra(collect($request->validated()));
      return response()->json(['dados' => $dados], Response::HTTP_CREATED);
    } catch (\Exception $e) {
      return response()->json(['erro' => $e->getMessage()], $e->getCode());
    }
  }
}

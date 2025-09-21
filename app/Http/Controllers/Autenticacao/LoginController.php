<?php

namespace App\Http\Controllers\Autenticacao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Autenticacao\LoginRequest;
use App\Service\Autenticacao\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
  public function store(LoginRequest $request, LoginService $service): JsonResponse {
    try {
      return response()->json($service->store(collect($request->validated())));
    } catch (\Exception $e) {
      return response()->json(['erro' => 'Erro ao conectar, entrar em contato com o suporte'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}

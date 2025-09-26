<?php

namespace App\Http\Controllers\Estoque;

use App\Http\Controllers\Controller;
use App\Http\Requests\Estoque\LocalEstoque\StoreLocalEstoqueRequest;
use App\Http\Resources\Estoque\LocalEstoqueResource;
use App\Models\LocalEstoque;
use App\Service\Estoque\LocalEstoque\CadastroService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalEstoqueController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    try {
      return LocalEstoqueResource::collection(LocalEstoque::query()->paginate(5));
    } catch (\Exception $e) {
      return response()->json(['error' => 'Erro ao carregar os locais de estoque: ' . $e->getMessage()], 500);
    }
  }

  /**
   * Store a newly created resource in storage.
   * @throws \Throwable
   */
  public function store(StoreLocalEstoqueRequest $request, CadastroService $cadastroService): JsonResponse
  {
    try {
      $localEstoque = $cadastroService->store($request->validated());
      return response()->json(['data' => $localEstoque], Response::HTTP_CREATED);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], $e->getCode());
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}

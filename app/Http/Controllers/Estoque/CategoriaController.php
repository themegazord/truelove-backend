<?php

namespace App\Http\Controllers\Estoque;

use App\Http\Controllers\Controller;
use App\Http\Requests\Estoque\Categoria\CategoriaRequest;
use App\Http\Resources\Estoque\CategoriaResource;
use App\Models\Categoria;
use App\Service\Estoque\Categoria\CadastroService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    try {
//      return response()->json(['error' => 'Erro ao carregar as categorias: '], 500);
      return CategoriaResource::collection(Categoria::all());
    } catch (\Exception $e) {
      return response()->json(['error' => 'Erro ao carregar as categorias: ' . $e->getMessage()], 500);
    }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CategoriaRequest $request, CadastroService $service)
  {
    try {
      return CategoriaResource::make($service->store($request->validated()));
    } catch (\Exception $e) {
      return response()->json(['error' => 'Erro ao cadastrar a categoria: ' . $e->getMessage()], 500);
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

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
  Route::prefix('autenticacao')->group(function () {
    Route::post('cadastro', [\App\Http\Controllers\Autenticacao\CadastroController::class, 'store'])->name('autenticacao.cadastro');
    Route::post('login', [\App\Http\Controllers\Autenticacao\LoginController::class, 'store'])->name('autenticacao.login');
  });
  Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', function (Request $request) {
      $user = $request->user()->load(['roles:id,nome']);

      $roles = $user->roles->pluck('nome')->all();
      return response()->json([
        'user' => [
          'id' => $user->id,
          'name' => $user->name,
          'email' => $user->email,
        ],
        'roles' => $roles,
      ]);
    });
    Route::post('logout', function (Request $request) {
      \Illuminate\Support\Facades\Auth::guard('web')->logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      return response()->noContent();
    });
    Route::prefix('estoque')->group(function () {
      Route::prefix('localestoque')->group(function () {
        Route::post('store', [\App\Http\Controllers\Estoque\LocalEstoqueController::class, 'store'])->name('localestoque.store');
        Route::get('index', [\App\Http\Controllers\Estoque\LocalEstoqueController::class, 'index'])->name('localestoque.index');
      });
      Route::prefix('categoria')->group(function () {
        Route::get('index', [\App\Http\Controllers\Estoque\CategoriaController::class, 'index'])->name('categoria.index');
        Route::post('store', [\App\Http\Controllers\Estoque\CategoriaController::class, 'store'])->name('categoria.store');
      });


    });
  });
});

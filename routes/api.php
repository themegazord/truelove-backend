<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
  Route::prefix('autenticacao')->group(function () {
    Route::post('cadastro', [\App\Http\Controllers\Autenticacao\CadastroController::class, 'store'])->name('autenticacao.cadastro');
    Route::post('login', [\App\Http\Controllers\Autenticacao\LoginController::class, 'store'])->name('autenticacao.login');
  });
});

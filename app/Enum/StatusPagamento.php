<?php // app/Enums/StatusPagamento.php
namespace App\Enums;

enum StatusPagamento: string
{
    case PENDENTE = 'pendente';
    case REQUER_ACAO = 'requer_acao';
    case AUTORIZADO = 'autorizado';
    case CAPTURADO = 'capturado';
    case FALHOU = 'falhou';
    case REEMBOLSADO = 'reembolsado';
}

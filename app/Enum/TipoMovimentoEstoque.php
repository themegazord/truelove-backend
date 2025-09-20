<?php
 app/Enums/TipoMovimentoEstoque.php
namespace App\Enums;

enum TipoMovimentoEstoque: string
{
    case AJUSTE = 'ajuste';
    case ALOCACAO = 'alocacao';
    case LIBERACAO = 'liberacao';
    case ENVIO = 'envio';
    case RECEBIMENTO = 'recebimento';
}

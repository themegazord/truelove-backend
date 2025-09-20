<?php

namespace App\Enums;

enum StatusProduto: string
{
    case RASCUNHO = 'rascunho';
    case ATIVO = 'ativo';
    case ARQUIVADO = 'arquivado';
}

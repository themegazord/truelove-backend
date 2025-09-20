<?php
namespace App\Enums;

enum StatusAvaliacao: string
{
    case PENDENTE = 'pendente';
    case APROVADA = 'aprovada';
    case REJEITADA = 'rejeitada';
}

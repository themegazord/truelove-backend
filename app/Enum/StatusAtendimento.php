<?php
 app/Enums/StatusAtendimento.php
namespace App\Enums;

enum StatusAtendimento: string
{
    case NAO_ATENDIDO = 'nao_atendido';
    case PARCIAL = 'parcial';
    case ATENDIDO = 'atendido';
}

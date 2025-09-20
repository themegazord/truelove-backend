<?php // app/Enums/TipoValorPromocao.php
namespace App\Enums;

enum TipoValorPromocao: string
{
    case PERCENTUAL = 'percentual';
    case FIXO = 'fixo';
    case FRETE = 'frete';
}

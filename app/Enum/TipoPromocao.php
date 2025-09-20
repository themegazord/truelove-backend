<?php // app/Enums/TipoPromocao.php
namespace App\Enums;

enum TipoPromocao: string
{
    case CUPOM = 'cupom';
    case AUTOMATICA = 'automatica';
}

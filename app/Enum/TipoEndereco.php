<?php
 app/Enums/TipoEndereco.php
namespace App\Enums;

enum TipoEndereco: string
{
    case ENTREGA = 'entrega';
    case COBRANCA = 'cobranca';
}

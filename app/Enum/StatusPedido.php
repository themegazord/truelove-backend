<?php // app/Enums/StatusPedido.php
namespace App\Enums;

enum StatusPedido: string
{
    case CRIADO = 'criado';
    case PAGO = 'pago';
    case CANCELADO = 'cancelado';
    case ENCERRADO = 'encerrado';
}

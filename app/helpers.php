<?php

function moneda($field)
{
    if($field == 'dolar'){
        return $moneda = 'US$ ';
    }elseif($field == 'soles'){
        return $moneda = 'S/. ';
    }

}

function precio($valor)
{
    $precio = number_format($valor, 2, '.', ',');
    return $precio;
}

function convertirFecha($fecha)
{
    return date_format(new DateTime($fecha), 'd/m/Y H:i');
}
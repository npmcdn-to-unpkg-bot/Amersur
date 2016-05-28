<?php

function moneda($field)
{
    if($field == 'dolar'){
        return $moneda = 'US$ ';
    }elseif($field == 'soles'){
        return $moneda = 'S/. ';
    }

}
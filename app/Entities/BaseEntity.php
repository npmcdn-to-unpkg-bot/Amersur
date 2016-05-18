<?php namespace Amersur\Entities;

use Amersur\Entities\Admin\OrderState;
use Illuminate\Database\Eloquent\Model;

use Jenssegers\Date\Date;

class BaseEntity extends Model {

	public function scopeTitulo($query, $titulo)
    {
        if(trim($titulo) != "")
        {
            $query->where('titulo', 'LIKE', "%$titulo%");
        }           
    }

    public function scopePublicar($query, $publicar)
    {
        if($publicar != "")
        {
            $query->where('publicar', $publicar);
        }
    }

    public function scopeDestacado($query, $dest)
    {
        if($dest != "")
        {
            $query->where('destacado', $dest);
        }
    }

    public function scopeOferta($query, $ofer)
    {
        if($ofer != "")
        {
            $query->where('oferta', $ofer);
        }
    }

    public function scopeDatefrom($query, $from)
    {
        if($from != "")
        {
            $query->where('created_at', '>', $from);
        }           
    }

    public function scopeDateto($query, $to)
    {
        if($to != "")
        {
            $query->where('created_at', '<', $to);
        }           
    }

    public function scopeLeido($query, $leido)
    {
        if($leido != "")
        {
            $query->where('leido', $leido);
        }
    }

    public function fechaTexto($datetime)
    {
        Date::setLocale('es');
        $fecha = Date::create($datetime->year, $datetime->month, $datetime->day, $datetime->hour, $datetime->minute, $datetime->second);
        $fecha = $fecha->format('d \\d\\e F \\d\\e\\l Y');
        return $fecha;
    }

    public function stateTitulo($state)
    {
        $order = OrderState::find($state);
        return $order->titulo;
    }

}
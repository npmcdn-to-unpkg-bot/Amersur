<?php namespace Amersur\Entities\Amersur;

use Illuminate\Database\Eloquent\SoftDeletes;
use Amersur\Entities\BaseEntity;

class Inmueble extends BaseEntity {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = ['titulo','slug_url','descripcion','contenido','area_total','area_construida','precio_alquiler','precio_venta','publicar','published_at'];

    public function user()
    {
        return $this->belongsTo('Amersur\Entities\User', 'user_id');
    }

	public function tipo()
    {
        return $this->belongsTo('Amersur\Entities\Amersur\InmuebleTipo', 'inmueble_tipo_id');
    }

    public function image()
    {
        return $this->hasMany('Amersur\Entities\Amersur\InmuebleImagen');
    }

    public function imagePr()
    {
        return $this->hasMany('Amersur\Entities\Amersur\InmuebleImagen')->where('orden', 0)->orderBy('created_at', 'desc')->first();
    }


    public function scopeBTipo($query, $input)
    {
        $rows = InmuebleTipo::all()->lists('titulo', 'id');

        if($input != "" && isset($rows[$input]))
        {
            $query->where('inmueble_tipo_id', $input);
        }
    }

    public function scopeBMoneda($query, $input)
    {
        if(trim($input) != "")
        {
            $query->where('moneda', $input);
        }
    }

    public function scopeBPrecioMax($query, $input)
    {
        if($input > 0)
        {
            $query->where('precio_venta', '<', $input);
        }
    }

}
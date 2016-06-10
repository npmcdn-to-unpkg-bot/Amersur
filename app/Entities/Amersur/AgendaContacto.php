<?php namespace Amersur\Entities\Amersur;

use Illuminate\Database\Eloquent\SoftDeletes;
use Amersur\Entities\BaseEntity;

class AgendaContacto extends BaseEntity {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = ['nombres','apellidos','email','direccion','telefono','nota'];

    public function getNombreCompletoAttribute()
    {
        return $this->nombres.' '.$this->apellidos;
    }

}
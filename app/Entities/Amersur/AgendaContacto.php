<?php namespace Amersur\Entities\Amersur;

use Illuminate\Database\Eloquent\SoftDeletes;
use Amersur\Entities\BaseEntity;

class AgendaContacto extends BaseEntity {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = ['nombres','apellidos','email','direccion','telefono','nota'];

    public function scopeNombres($query, $value)
    {
        if(trim($value) != "")
        {
            $query->where('nombres', 'LIKE', "%$value%");
        }
    }

    public function scopeApellidos($query, $value)
    {
        if(trim($value) != "")
        {
            $query->where('apellidos', 'LIKE', "%$value%");
        }
    }

    public function scopeEmail($query, $value)
    {
        if(trim($value) != "")
        {
            $query->where('email', 'LIKE', "%$value%");
        }
    }

    public function scopeTelefono($query, $value)
    {
        if(trim($value) != "")
        {
            $query->where('telefono', 'LIKE', "%$value%");
        }
    }

    public function getNombreCompletoAttibutes()
    {
        return $this->nombres.' '.$this->apellidos;
    }

}
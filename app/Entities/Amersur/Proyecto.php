<?php namespace Amersur\Entities\Amersur;

use Illuminate\Database\Eloquent\SoftDeletes;
use Amersur\Entities\BaseEntity;

class Proyecto extends BaseEntity {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = ['titulo','descripcion','contenido','publicar','enlace','published_at'];

    public function image()
    {
        return $this->hasMany(ProyectoImagen::class);
    }

    public function imagePr()
    {
        return $this->hasMany(ProyectoImagen::class)->where('orden', 0)->orderBy('created_at', 'desc')->first();
    }

}
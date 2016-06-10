<?php namespace Amersur\Entities\Amersur;

use Illuminate\Database\Eloquent\SoftDeletes;
use Amersur\Entities\BaseEntity;

class Proyecto extends BaseEntity {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = ['titulo','descripcion','imagen','imagen_carpeta'];

}
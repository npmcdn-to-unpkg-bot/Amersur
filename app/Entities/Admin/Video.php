<?php namespace Amersur\Entities\Admin;

use Amersur\Entities\BaseEntity;

use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends BaseEntity{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['titulo','descripcion','contenido','imagen','imagen_carpeta','video','publicar','published_at','user_id'];

    public function user()
    {
        return $this->belongsTo('Amersur\Entities\User', 'user_id');
    }

} 
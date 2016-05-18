<?php namespace Amersur\Entities\Admin;

use Illuminate\Database\Eloquent\SoftDeletes;
use Amersur\Entities\BaseEntity;

class Post extends BaseEntity{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['titulo','descripcion','contenido','imagen','imagen_carpeta','publicar','category_id','post_order_id','published_at','user_id'];

    public function user()
    {
        return $this->belongsTo('Amersur\Entities\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('Amersur\Entities\Admin\PostCategory', 'post_category_id');
    }

    public function postOrder()
    {
        return $this->belongsTo('Amersur\Entities\Admin\PostOrder', 'post_order_id');
    }

    public function postPhoto()
    {
        return $this->hasMany('Amersur\Entities\Admin\PostPhoto');
    }

    public function postHistory()
    {
        return $this->hasMany('Amersur\Entities\Admin\PostHistory');
    }

    public function postUserDelete()
    {
        return $this->hasMany('Amersur\Entities\Admin\PostHistory')->whereType('delete')->orderBy('created_at', 'desc')->first();
    }

    public function scopeCategory($query, $categoria)
    {
        $categorias = PostCategory::all()->lists('titulo', 'id');

        if($categoria != "" && isset($categorias[$categoria]))
        {
            $query->where('post_category_id', $categoria);
        }
    }

} 
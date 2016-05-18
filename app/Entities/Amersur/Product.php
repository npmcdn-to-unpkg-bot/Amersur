<?php namespace Amersur\Entities\Amersur;

use Illuminate\Database\Eloquent\SoftDeletes;
use Amersur\Entities\BaseEntity;

class Product extends BaseEntity {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = ['titulo','slug_url','descripcion','contenido','imagen','imagen_carpeta','money_id','precio','material','color','talla','peso_gr',
        'provider_id','category_id','brand_id','publicar','normal','destacado','oferta','oferta_precio','published_at','logistica_origen','logistica_destino',
        'transporte_origen','transporte_destino','gastos_envio','precio_costo','utilidad','gastos_operativos','costos_envio','impuesto','precio_venta',
        'precio_oferta','created_at'];

    public function user()
    {
        return $this->belongsTo('Amersur\Entities\User', 'user_id');
    }

	public function category()
    {
        return $this->belongsTo('Amersur\Entities\Amersur\Category', 'category_id');
    }

    public function provider()
    {
        return $this->belongsTo('Amersur\Entities\Amersur\Provider', 'provider_id');
    }

    public function image()
    {
        return $this->hasMany('Amersur\Entities\Amersur\ProductImage');
    }

    public function imagePr()
    {
        return $this->hasMany('Amersur\Entities\Amersur\ProductImage')->where('orden', 0)->orderBy('created_at', 'desc')->first();
    }

    public function history()
    {
        return $this->hasMany('Amersur\Entities\Amersur\ProductHistory');
    }

    public function wishlist()
    {
        return $this->hasMany('Amersur\Entities\Amersur\Wishlist');
    }

    public function userDelete()
    {
        return $this->hasMany('Amersur\Entities\Amersur\ProductHistory')->whereType('delete')->orderBy('created_at', 'desc')->first();
    }

    /*
     * Calculo de Costos
     */
    //PRECIO COSTO
    public function precioCosto($money, $valor)
    {
        $cambio = Money::where('id',$money)->first();
        $moneda = $cambio->valor * $valor;
        $precio = number_format($moneda, 2, '.', ',');
        return $precio;
    }

    //UTILIDADES
    public function utilidades($precio)
    {
        $utilidades = Utility::all();

        foreach($utilidades as $item)
        {
            if($precio >= $item->desde AND $precio <= $item->hasta)
            {
                $precio = $precio * ($item->porcentaje / 100);
                $utilidad = number_format($precio, 2, '.', ',');
                return $utilidad;
            }
        }
    }

    //GASTOS OPERATIVOS
    public function logisticaOrigen($peso_gr, $registro)
    {
        if($registro == null){
            $service = Servicio::where('predeterminado', 1)->first();
        }else{
            $service = Servicio::where('id', $registro)->first();
        }

        $tc = Money::where('id', $service->money_id)->first();
        $formula = $service->costo_serv_hra * ($peso_gr / $service->peso_min) * $tc->valor * $service->tiempo_min;
        return $formula;
    }

    public function logisticaDestino($peso_gr, $registro)
    {
        if($registro == null){
            $service = Servicio::where('predeterminado', 1)->first();
        }else{
            $service = Servicio::where('id', $registro)->first();
        }

        $tc = Money::where('id', $service->money_id)->first();
        $formula = $service->costo_serv_hra * ($peso_gr / $service->peso_min) * $tc->valor * $service->tiempo_max;
        return $formula;
    }

    public function transporteOrigen($peso_gr, $registro)
    {
        if($registro == null){
            $service = Servicio::where('predeterminado', 1)->first();
        }else{
            $service = Servicio::where('id', $registro)->first();
        }

        $tc = Money::where('id', $service->money_id)->first();
        $formula = $service->costo_serv_hra * ($peso_gr / $service->peso_min) * $tc->valor;
        return $formula;
    }

    public function transporteDestino($peso_gr, $registro)
    {
        if($registro == null){
            $service = Servicio::where('predeterminado', 1)->first();
        }else{
            $service = Servicio::where('id', $registro)->first();
        }

        $tc = Money::where('id', $service->money_id)->first();
        $formula = $service->costo_serv_hra * ($peso_gr / $service->peso_min) * $tc->valor;
        return $formula;
    }

    public function gastosOperativos($peso_gr, $logOrigen, $logDestino, $traOrigen, $traDestino)
    {
        $logistica_origen = $this->logisticaOrigen($peso_gr, $logOrigen);
        $logistica_destino = $this->logisticaDestino($peso_gr, $logDestino);
        $transporte_origen = $this->transporteOrigen($peso_gr, $traOrigen);
        $transporte_destino = $this->transporteDestino($peso_gr, $traDestino);

        $gastos = $logistica_origen + $logistica_destino + $transporte_origen + $transporte_destino;

        return number_format($gastos, 2, '.', ',');
    }

    //COSTOS DE ENVIO
    public function costosEnvio($peso_gr, $registro)
    {
        if($registro == null){
            $service = Servicio::where('predeterminado', 1)->first();
        }else{
            $service = Servicio::where('id', $registro)->first();
        }

        $tc = Money::where('id', $service->money_id)->first();
        $formula = ($peso_gr / $service->peso_min)*($tc->valor * $service->costo_por_kg);
        return number_format($formula, 2, '.', ',');
    }

    //IMPUESTO
    public function impuesto($gastos_operativos, $precio_soles, $utilidad, $gastos_envio)
    {
        $formula = ($gastos_operativos + $precio_soles + $utilidad + $gastos_envio) * (18 / 100);
        return number_format($formula, 2, '.', ',');
    }

    //PRECIO VENTA
    public function precioVenta($precio_soles, $utilidad, $gastos_operativos, $gastos_envio, $impuesto)
    {
        $formula = $precio_soles + $utilidad + $gastos_operativos + $gastos_envio + $impuesto;
        return number_format($formula, 2, '.', ',');
    }

    //PRECIO OFERTA
    public function precioOferta($oferta_option, $porcentaje, $precio_venta)
    {
        if($oferta_option == 1)
        {
            $oferta = $porcentaje;
            $precio_oferta = $precio_venta - ($precio_venta * ($oferta / 100));
        }else{
            $precio_oferta = $precio_venta - ($precio_venta * (0 / 100));
        }

        return number_format($precio_oferta, 2, '.', ',');
    }
    

    public function wishlistProduct($product, $user)
    {
        $wish = Wishlist::where('product_id', $product)->where('user_id', $user)->first();
        return $wish;
    }

    public function scopeCategory($query, $categoria)
    {
        $categorias = Category::all()->lists('titulo', 'id');

        if($categoria != "" && isset($categorias[$categoria]))
        {
            $query->where('category_id', $categoria);
        }
    }

    public function scopeBrand($query, $brand)
    {
        if(count($brand) == 1)
        {
            $marca = Brand::where('slug_url', $brand[0])->first();

            $query->where('brand_id', $marca->id);
        }
        elseif(count($brand) > 1)
        {
            foreach ($brand as $key => $value)
            {
                $valor = implode(',', array_map(function($value)
                {
                    $marca = Brand::where('slug_url', $value)->select('id')->first();

                    return trim($marca->id, ',');
                }, $brand));

            }

            $query->whereIn('brand_id', explode(',', $valor));
        }
    }
	
}
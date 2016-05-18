<?php namespace Amersur\Repositories\Amersur;

use Illuminate\Http\Request;
use Amersur\Repositories\BaseRepo;

use Amersur\Entities\Amersur\Money;
use Amersur\Entities\Amersur\Product;
use Amersur\Entities\Amersur\Servicio;
use Amersur\Entities\Amersur\Utility;

class ProductRepo extends BaseRepo{

    public function getModel()
    {
        return new Product;
    }

    //GRAFICO AVANCE
    public function graficoAvance()
    {
        return $this->getModel()
                    ->select([\DB::raw('DATE_FORMAT(created_at,"%d/%m/%Y") fecha, UNIX_TIMESTAMP(created_at) created, COUNT(*) avance')])
                    ->orderBy('created_at', 'asc')
                    ->groupBy('fecha')
                    ->havingRaw('COUNT(*)')
                    ->get();
    }

    //BUSQUEDAS DE REGISTROS ELIMINADOS
    public function findAndPaginateDeletes(Request $request)
    {
        return $this->getModel()
                    ->onlyTrashed()
                    ->titulo($request->get('titulo'))
                    ->orderBy('deleted_at', 'desc')
                    ->paginate();
    }

    //BUSQUEDA DE REGISTROS
    public function findAndPaginate(Request $request)
    {
        return $this->getModel()
                    ->titulo($request->get('titulo'))
                    ->category($request->get('category'))
                    ->destacado($request->get('destacado'))
                    ->oferta($request->get('oferta'))
                    ->publicar($request->get('publicar'))
                    ->orderBy('created_at', 'desc')
                    ->paginate();
    }

    //MOSTRAR PRODUCTOS DE CATEGORIA
    public function findProductsCategory($category, $paginate)
    {
        return $this->getModel()
                    ->where('category_id', $category)
                    ->orderBy('titulo', 'asc')
                    ->paginate($paginate);
    }

    //BUSCAR PRODUCTO - ORDENAR - PAGINACION
    public function findOrderPaginate(Request $request, $field, $order, $paginate)
    {
        return $this->getModel()
                    ->titulo($request->get('pr'))
                    ->orderBy($field, $order)
                    ->paginate($paginate);
    }

    //MOSTRAR OFERTAS
    public function orderOferPag($field, $order, $value)
    {
        return $this->getModel()
                    ->where('oferta', 1)
                    ->where('publicar', 1)
                    ->orderBy($field, $order)
                    ->paginate($value);
    }

    //MOSTRAR DESTACADOS
    public function orderDestPag($field, $order, $value)
    {
        return $this->getModel()
                    ->where('destacado', 1)
                    ->where('publicar', 1)
                    ->orderBy($field, $order)
                    ->paginate($value);
    }

    //FILTRO PRODUCTOS
    public function filterProduct($category, Request $request)
    {
        return $this->getModel()
                    ->where('category_id', $category)
                    ->brand($request->get('brand'))
                    ->paginate(16);
    }

    //BUSCAR
    public function buscar(Request $request)
    {
        $q = $request->input('pr');

        return $this->getModel()
                    ->whereRaw("MATCH(titulo,descripcion) AGAINST(?)",array($q))
                    ->paginate(24);
    }

    //BUSCAR JSON
    public function buscarJson(Request $request)
    {
        return $this->getModel()
                    ->titulo($request->input('q'))
                    ->orderBy('titulo', 'asc')
                    ->get();
    }

    //PRECIO
    public function price($money, $valor)
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

    //GASTOS DE ENVIO
    public function costoEnvio($peso_gr, $registro)
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
        if($oferta_option == 2)
        {
            $precio_oferta = $precio_venta - ($precio_venta * ($porcentaje / 100));
        }else{
            $precio_oferta = $precio_venta - ($precio_venta * (0 / 100));
        }

        return number_format($precio_oferta, 2, '.', ',');
    }
}
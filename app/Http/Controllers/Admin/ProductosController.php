<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Amersur\CategoryRepo;
use Amersur\Repositories\Amersur\MoneyRepo;

use Amersur\Entities\Amersur\Product;
use Amersur\Repositories\Amersur\ProductRepo;

use Amersur\Entities\Amersur\ProductImage;
use Amersur\Repositories\Amersur\ProductImageRepo;

use Amersur\Entities\Amersur\ProductPrice;
use Amersur\Repositories\Amersur\ProductPriceRepo;

use Amersur\Repositories\Amersur\ServicioRepo;

use Amersur\Entities\Amersur\Utility;

use Amersur\Entities\Admin\History;
use Amersur\Repositories\Admin\HistoryRepo;

class ProductosController extends Controller {

	protected $rules = [
        'titulo' => 'required',
        'descripcion' => 'required|min:10|max:255',
        'contenido' => 'required',
        'moneda' => 'required',
        'precio' => 'required',
        'categoria' => 'required',
        'published_at' => 'required',
        'publicar' => 'required|in:1,0',
        'opciones' => 'required|in:0,1,2',
        'logistica_origen' => 'required',
        'logistica_destino' => 'required',
        'transporte_origen' => 'required',
        'transporte_destino' => 'required',
        'gastos_envio' => 'required'
	];

	protected $categoryRepo;
	protected $moneyRepo;
	protected $productRepo;
    protected $productImageRepo;
    protected $productPriceRepo;
    private $servicioRepo;
	protected $historyRepo;

	protected $tabla = 'products';

    public function __construct(CategoryRepo $categoryRepo,
								MoneyRepo $moneyRepo,
								ProductRepo $productRepo,
                                ProductImageRepo $productImageRepo,
                                ProductPriceRepo $productPriceRepo,
                                ServicioRepo $servicioRepo,
								HistoryRepo $historyRepo)
	{
		$this->categoryRepo = $categoryRepo;
		$this->moneyRepo = $moneyRepo;
		$this->productRepo = $productRepo;
        $this->productImageRepo = $productImageRepo;
        $this->productPriceRepo = $productPriceRepo;
        $this->servicioRepo = $servicioRepo;
        $this->historyRepo = $historyRepo;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$posts = $this->productRepo->findAndPaginate($request);
		$category = $this->categoryRepo->all()->lists('titulo', 'id');
				
		return view('admin.productos.list', compact('posts','category'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$category = $this->categoryRepo->all()->lists('titulo', 'id');
		$money = $this->moneyRepo->all()->lists('titulo', 'id');
        $services = $this->servicioRepo->all()->lists('titulo', 'id');
		$selected = [];

		return view('admin.productos.create', compact('category','money','services','selected'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, $this->rules);

		//VARIABLES
		$titulo = $request->input('titulo');
		$slug_url = $this->productRepo->SlugUrl($titulo);
		$categoria = $request->input('categoria');
		$moneda = $request->input('moneda');
		$history = json_encode($request->except('_method','_token'));

        //OPCIONES
        $opciones = $request->input('opciones');
        if($opciones == 0){
            $normal = 1; $destacado = 0; $oferta = 0;
            $oferta_descuento = 0;
        }elseif($opciones == 1){
            $normal = 0; $destacado = 1; $oferta = 0;
            $oferta_descuento = 0;
        }elseif($opciones == 2){
            $normal = 0; $destacado = 0; $oferta = 1;
            $oferta_descuento = $request->input('oferta_precio');
        }

		//GUARDAR DATOS
		$post = new Product($request->all());
		$post->slug_url = $slug_url;
		$post->category_id = $categoria;
		$post->money_id = $moneda;
		$post->user_id = Auth::user()->profile->id;
        $post->normal = $normal;
        $post->destacado = $destacado;
        $post->oferta = $oferta;
        $post->oferta_precio = $oferta_descuento;
		$post->history = $history;
		$this->productRepo->create($post, $request->all());

        //BUSCAR REGISTRO POR TITULO
        $postCreate = $this->productRepo->where('titulo', $titulo)->first();

		//MENSAJE
		flash()->success('El registro se agregó satisfactoriamente.');

		//REDIRECCIONAR A PAGINA PARA VER DATOS
		return redirect()->route('admin.productos.img.create', $postCreate->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = $this->productRepo->findOrFail($id);
		$category = $this->categoryRepo->all()->lists('titulo', 'id');
		$money = $this->moneyRepo->all()->lists('titulo', 'id');
        $services = $this->servicioRepo->all()->lists('titulo', 'id');

		return view('admin.productos.edit', compact('post','category','money','services'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//BUSCAR ID
		$post = $this->productRepo->findOrFail($id);

		//VALIDACION DE DATOS
		$this->validate($request, $this->rules);

		//VARIABLES
		$titulo = $request->input('titulo');
		$slug_url = $this->productRepo->SlugUrl($titulo);
		$categoria = $request->input('categoria');
		$moneda = $request->input('moneda');
        $precio = $request->input('precio');

        //COMPARAR PRECIO
        if($precio <> $post->precio)
        {
            $price = new ProductPrice();
            $price->product_id = $id;
            $price->money_id = $moneda;
            $price->precio_unidad = $precio;
            $price->user_id = Auth::user()->id;
            $this->productPriceRepo->create($price, $request->all());
        }

        //OPCIONES
        $opciones = $request->input('opciones');
        if($opciones == 0){
            $normal = 1; $destacado = 0; $oferta = 0;
            $oferta_descuento = 0;
        }elseif($opciones == 1){
            $normal = 0; $destacado = 1; $oferta = 0;
            $oferta_descuento = 0;
        }elseif($opciones == 2){
            $normal = 0; $destacado = 0; $oferta = 1;
            $oferta_descuento = $request->input('oferta_precio');
        }

		//GUARDAR DATOS
		$post->slug_url = $slug_url;
		$post->category_id = $categoria;
		$post->money_id = $moneda;
        $post->normal = $normal;
        $post->destacado = $destacado;
        $post->oferta = $oferta;
        $post->oferta_precio = $oferta_descuento;
		$this->productRepo->update($post, $request->except('imagen'));

		//GUARDAR HISTORIAL
		$history = new History;
		$this->historyRepo->saveHistory($history, $this->tabla, $id, $request, 'update');

		//MENSAJE
		flash()->success('El registro se actualizó satisfactoriamente.');

		//REDIRECCIONAR A PAGINA PARA VER DATOS
		return redirect()->route('admin.productos.index');
	}


    /*
     * Calcular costos de producto
     */
    public function calcularCosto(Request $request)
    {
        $in_moneda = $request->input('moneda');
        $in_moneda_precio = $request->input('precio');
        $in_peso_gr = $request->input('peso_gr');
        $in_logistica_origen = $request->input('logistica_origen');
        $in_logistica_destino = $request->input('logistica_destino');
        $in_transporte_origen = $request->input('transporte_origen');
        $in_transporte_destino = $request->input('transporte_destino');
        $in_gastos_envio = $request->input('gastos_envio');

        //PRECIO EN SOLES
        $precio_soles = $this->productRepo->price($in_moneda, $in_moneda_precio);

        //UTILIDADES
        $utilidad = $this->productRepo->utilidades($precio_soles);

        //GASTOS OPERATIVOS
        $gastos_operativos = $this->productRepo->gastosOperativos($in_peso_gr, $in_logistica_origen, $in_logistica_destino, $in_transporte_origen, $in_transporte_destino);

        //GASTOS DE ENVIO
        $gastos_envio = $this->productRepo->costoEnvio($in_peso_gr, $in_gastos_envio);

        //IMPUESTO
        $impuesto = $this->productRepo->impuesto($gastos_operativos, $precio_soles, $utilidad, $gastos_envio);

        //PRECIO VENTA
        $precio_venta = $this->productRepo->precioVenta($precio_soles, $utilidad, $gastos_operativos, $gastos_envio, $impuesto);

        //OFERTA
        $precio_oferta = $this->productRepo->precioOferta($request->input('opciones'), $request->input('oferta_precio'), $precio_venta);

        if($request->ajax())
        {
            return response()->json([
                'precio_costo'      => $precio_soles,
                'utilidad'          => $utilidad,
                'gastos_operativos' => $gastos_operativos,
                'gastos_envio'      => $gastos_envio,
                'impuesto'          => $impuesto,
                'precio_venta'      => $precio_venta,
                'precio_oferta'     => $precio_oferta,
            ]);
        }

        return redirect()->route('admin.productos.index');

    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		//GUARDAR HISTORIAL
		$history = new History;
		$this->historyRepo->saveHistory($history, $this->tabla, $id, $request, 'delete');

		//BUSCAR ID PARA ELIMINAR
		$post = $this->productRepo->findOrFail($id);
		$post->delete();

		$message = 'El registro se eliminó satisfactoriamente.';

		if($request->ajax())
		{
			return response()->json([
				'message' => $message
			]);
		}

		return redirect()->route('admin.productos.index');
	}


    /*
     * Cambiar estado de Destacado
     */
    public function destacado($id, Request $request)
    {
        //BUSCAR ID PARA ELIMINAR
        $post = $this->productRepo->findOrFail($id);

        if($post->destacado == 0){
            $destacado = 1;
        }else{
            $destacado = 0;
        }

        $post->destacado = $destacado;
        $this->productRepo->update($post, $request->all());

        $message = 'El registro se modificó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message,
                'estado'  => $destacado
            ]);
        }

        return redirect()->route('admin.productos.index');
    }


    /*
     * Cambiar estado de Oferta
     */
    public function oferta($id, Request $request)
    {
        //BUSCAR ID PARA ELIMINAR
        $post = $this->productRepo->findOrFail($id);

        if($post->oferta == 0){
            $oferta = 1;
        }else{
            $oferta = 0;
        }

        $post->oferta = $oferta;
        $this->productRepo->update($post, $request->all());

        $message = 'El registro se modificó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message,
                'estado'  => $oferta
            ]);
        }

        return redirect()->route('admin.productos.index');
    }


    /*
     * Cambiar estado de Publicar
     */
    public function publicar($id, Request $request)
    {
        //BUSCAR ID PARA ELIMINAR
        $post = $this->productRepo->findOrFail($id);

        if($post->publicar == 0){
            $publicar = 1;
        }else{
            $publicar = 0;
        }

        $post->publicar = $publicar;
        $this->productRepo->update($post, $request->all());

        $message = 'El registro se modificó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message,
                'estado'  => $publicar
            ]);
        }

        return redirect()->route('admin.productos.index');
    }

    /**
     * Historial de precios
     */
    public function price($id)
    {
        $post = $this->productRepo->findOrFail($id);
        $posts = $this->productPriceRepo->where('product_id', $id)->orderBy('created_at', 'desc')->paginate();

        return view('admin.productos.prices', compact('post','posts'));
    }


	/**
	 * Historial de cambios del registro
	 */
	public function history($id)
	{
		$post = $this->productRepo->findOrFail($id);
		$posts = $this->historyRepo->findHistory($this->tabla, $id);

		return view('admin.productos.history', compact('post','posts'));
	}


	/**
	 * Lista de registros eliminados
	 */
	public function listsDeletes(Request $request)
	{
		$posts = $this->productRepo->findAndPaginateDeletes($request);
		$category = $this->categoryRepo->all()->lists('titulo', 'id');

		return view('admin.productos.list-deletes', compact('posts', 'category'));
	}


	/**
	 * Eliminacion completa de registro
	 */
	public function destroyTotal($id, Request $request)
	{
		$post = $this->productRepo->findTrash($id);
		$post->forceDelete();

		$message = 'El registro se eliminó satisfactoriamente.';

		if($request->ajax())
		{
			return response()->json([
				'message' => $message
			]);
		}

		return redirect()->route('admin.productos.listsDeletes');
	}


	/**
	 * Restaurar registro
	 */
	public function restore($id, Request $request)
	{
		//GUARDAR HISTORIAL
		$history = new History;
		$this->historyRepo->saveHistory($history, $this->tabla, $id, $request, 'restore');

		$post = $this->productRepo->findTrash($id);
		$post->restore();

		$message = 'El registro se restauró satisfactoriamente.';

		if($request->ajax())
		{
			return response()->json([
				'message' => $message
			]);
		}

		return redirect()->route('admin.productos.listsDeletes');
	}

    /*
     * Todos los productos en JSON
     */
    public function productsAll(Request $request)
    {
        $products = $this->productRepo->buscarJson($request);

        return response()->json($products);
    }


    /**
     * Fotos de Post
     *
     * @param  int  $id
     * @return Response
     */
    public function photosList($post)
    {
        $posts = $this->productRepo->findOrFail($post);
        $photos = $this->productImageRepo->where('product_id', $post)->orderBy('orden','asc')->get();

        return view('admin.productos-images.list', compact('posts', 'photos'));
    }

    public function photosOrder($post, Request $request)
    {
        if($request->ajax())
        {
            $sortedval = $_POST['listPhoto'];
            try{
                foreach ($sortedval as $key => $sort){
                    $sortPhoto = ProductImage::find($sort);
                    $sortPhoto->orden = $key;
                    $sortPhoto->save();
                }
            }
            catch (Exception $e)
            {
                return 'false';
            }
        }
    }

    public function photosCreate($post)
    {
        $posts = $this->productRepo->findOrFail($post);

        return view('admin.productos-images.upload', compact('posts'));
    }

    public function photosStore($post, Request $request)
    {
        //CREAR CARPETA CON FECHA Y MOVER IMAGEN
        $this->productRepo->CrearCarpeta();
        $ruta = "upload/".$this->productRepo->FechaCarpeta();
        $archivo = $request->file('file');
        $imagen = $this->productRepo->FileMove($archivo, $ruta);
        $imagen_carpeta = $this->productRepo->FechaCarpeta();

        //GUARDAR DATOS
        $photo = new ProductImage();
        $photo->imagen = $imagen;
        $photo->imagen_carpeta = $imagen_carpeta;
        $photo->product_id = $post;
        $photo->save();
    }

    public function photosDelete($post, $id, Request $request)
    {
        $photo = $this->productImageRepo->findOrFail($id);
        $photo->delete();

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.productos.img.list', $post);
    }
	
}
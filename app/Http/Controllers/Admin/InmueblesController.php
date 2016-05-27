<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Amersur\CategoryRepo;

use Amersur\Entities\Amersur\Product;
use Amersur\Repositories\Amersur\ProductRepo;

use Amersur\Entities\Amersur\ProductImage;
use Amersur\Repositories\Amersur\ProductImageRepo;

use Amersur\Repositories\Amersur\ServicioRepo;

use Amersur\Entities\Admin\History;
use Amersur\Repositories\Admin\HistoryRepo;

class InmueblesController extends Controller {

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
	protected $productRepo;
    protected $productImageRepo;
    protected $productPriceRepo;
    protected $servicioRepo;
	protected $historyRepo;

	protected $tabla = 'products';

    public function __construct(CategoryRepo $categoryRepo,
								ProductRepo $productRepo,
                                ProductImageRepo $productImageRepo,
                                ServicioRepo $servicioRepo,
								HistoryRepo $historyRepo)
	{
		$this->categoryRepo = $categoryRepo;
		$this->productRepo = $productRepo;
        $this->productImageRepo = $productImageRepo;
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
				
		return view('admin.inmuebles.list', compact('posts','category'));
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

		return view('admin.inmuebles.create', compact('category','money','services','selected'));
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

		//GUARDAR DATOS
		$post = new Product($request->all());
		$post->slug_url = $slug_url;
		$post->category_id = $categoria;
		$post->money_id = $moneda;
		$post->user_id = Auth::user()->profile->id;
		$post->history = $history;
		$this->productRepo->create($post, $request->all());

        //BUSCAR REGISTRO POR TITULO
        $postCreate = $this->productRepo->where('titulo', $titulo)->first();

		//MENSAJE
		flash()->success('El registro se agregó satisfactoriamente.');

		//REDIRECCIONAR A PAGINA PARA VER DATOS
		return redirect()->route('admin.inmuebles.img.create', $postCreate->id);
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

		return view('admin.inmuebles.edit', compact('post','category','money','services'));
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
		return redirect()->route('admin.inmuebles.index');
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

		return redirect()->route('admin.inmuebles.index');
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

        return redirect()->route('admin.inmuebles.index');
    }


	/**
	 * Historial de cambios del registro
	 */
	public function history($id)
	{
		$post = $this->productRepo->findOrFail($id);
		$posts = $this->historyRepo->findHistory($this->tabla, $id);

		return view('admin.inmuebles.history', compact('post','posts'));
	}


	/**
	 * Lista de registros eliminados
	 */
	public function listsDeletes(Request $request)
	{
		$posts = $this->productRepo->findAndPaginateDeletes($request);
		$category = $this->categoryRepo->all()->lists('titulo', 'id');

		return view('admin.inmuebles.list-deletes', compact('posts', 'category'));
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

		return redirect()->route('admin.inmuebles.listsDeletes');
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

        return view('admin.inmueble-imagenes.list', compact('posts', 'photos'));
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

        return view('admin.inmueble-imagenes.upload', compact('posts'));
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

        return redirect()->route('admin.inmuebles.img.list', $post);
    }
	
}
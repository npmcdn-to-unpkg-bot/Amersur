<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Amersur\InmuebleTipoRepo;

use Amersur\Entities\Amersur\Inmueble;
use Amersur\Repositories\Amersur\InmuebleRepo;

use Amersur\Entities\Amersur\InmuebleImagen;
use Amersur\Repositories\Amersur\InmuebleImagenRepo;

use Amersur\Repositories\Admin\HistoryRepo;

class InmueblesController extends Controller {

	protected $rules = [
        'titulo' => 'required',
        'contenido' => 'required',
        'tipo' => 'required|exists:inmueble_tipos,id',
        'area_total' => 'string',
        'precio_venta' => 'numeric',
        'enlace' => 'url',
        'publicar' => 'required|in:1,0',
        'published_at' => 'required'
	];

    protected $inmuebleTipoRepo;
	protected $inmuebleRepo;
    protected $inmuebleImagenRepo;

    public function __construct(InmuebleRepo $inmuebleRepo,
                                InmuebleTipoRepo $inmuebleTipoRepo,
                                InmuebleImagenRepo $inmuebleImagenRepo,
								HistoryRepo $historyRepo)
	{
        $this->inmuebleRepo = $inmuebleRepo;
        $this->inmuebleTipoRepo = $inmuebleTipoRepo;
        $this->inmuebleImagenRepo = $inmuebleImagenRepo;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$posts = $this->inmuebleRepo->findAndPaginate($request);
		$category = $this->inmuebleTipoRepo->all()->lists('titulo', 'id');
				
		return view('admin.inmuebles.list', compact('posts','category'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$category = $this->inmuebleTipoRepo->all()->lists('titulo', 'id');
		$selected = [];

		return view('admin.inmuebles.create', compact('category','distrito','selected'));
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
		$slug_url = $this->inmuebleRepo->SlugUrl($titulo);
		$tipo = $request->input('tipo');

		//GUARDAR DATOS
		$post = new Inmueble($request->all());
		$post->slug_url = $slug_url;
		$post->inmueble_tipo_id = $tipo;
		$rowSave = $this->inmuebleRepo->create($post, $request->all());

        //MENSAJE
		flash()->success('El registro se agregó satisfactoriamente.');

		//REDIRECCIONAR A PAGINA PARA VER DATOS
		return redirect()->route('admin.inmuebles.img.create', $rowSave->id);
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
		$post = $this->inmuebleRepo->findOrFail($id);
        $category = $this->inmuebleTipoRepo->all()->lists('titulo', 'id');

		return view('admin.inmuebles.edit', compact('post','category','distrito'));
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
		$post = $this->inmuebleRepo->findOrFail($id);

		//VALIDACION DE DATOS
		$this->validate($request, $this->rules);

		//VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $this->inmuebleRepo->SlugUrl($titulo);
        $tipo = $request->input('tipo');

		//GUARDAR DATOS
        $post->slug_url = $slug_url;
        $post->inmueble_tipo_id = $tipo;
		$this->inmuebleRepo->update($post, $request->all());

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
		//BUSCAR ID PARA ELIMINAR
		$post = $this->inmuebleRepo->findOrFail($id);
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
        $post = $this->inmuebleRepo->findOrFail($id);

        if($post->publicar == 0){
            $publicar = 1;
        }else{
            $publicar = 0;
        }

        $post->publicar = $publicar;
        $this->inmuebleRepo->update($post, $request->all());

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
	 * Eliminacion completa de registro
	 */
	public function destroyTotal($id, Request $request)
	{
		$post = $this->inmuebleRepo->findTrash($id);
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



    /**
     * Fotos de Post
     *
     * @param  int  $id
     * @return Response
     */
    public function photosList($post)
    {
        $posts = $this->inmuebleRepo->findOrFail($post);
        $photos = $this->inmuebleImagenRepo->where('inmueble_id', $post)->orderBy('orden','asc')->get();

        return view('admin.inmueble-imagenes.list', compact('posts', 'photos'));
    }

    public function photosOrder($post, Request $request)
    {
        if($request->ajax())
        {
            $sortedval = $_POST['listPhoto'];
            try{
                foreach ($sortedval as $key => $sort){
                    $sortPhoto = InmuebleImagen::find($sort);
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
        $posts = $this->inmuebleRepo->findOrFail($post);

        return view('admin.inmueble-imagenes.upload', compact('posts'));
    }

    public function photosStore($post, Request $request)
    {
        //CREAR CARPETA CON FECHA Y MOVER IMAGEN
        $this->inmuebleRepo->CrearCarpeta();
        $ruta = "upload/".$this->inmuebleRepo->FechaCarpeta();
        $archivo = $request->file('file');
        $imagen = $this->inmuebleRepo->FileMove($archivo, $ruta);
        $imagen_carpeta = $this->inmuebleRepo->FechaCarpeta();

        //GUARDAR DATOS
        $photo = new InmuebleImagen();
        $photo->imagen = $imagen;
        $photo->imagen_carpeta = $imagen_carpeta;
        $photo->inmueble_id = $post;
        $photo->save();
    }

    public function photosDelete($post, $id, Request $request)
    {
        $photo = $this->inmuebleImagenRepo->findOrFail($id);
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
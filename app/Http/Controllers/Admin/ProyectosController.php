<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Amersur\Proyecto;
use Amersur\Repositories\Amersur\ProyectoRepo;

use Amersur\Entities\Amersur\ProyectoImagen;
use Amersur\Repositories\Amersur\ProyectoImagenRepo;

class ProyectosController extends Controller {

    protected  $rules = [
        'titulo' => 'required',
        'contenido' => 'required',
        'enlace' => 'required|url'
    ];

    protected $proyectoRepo;
    protected $proyectoImagenRepo;

    public function __construct(ProyectoRepo $proyectoRepo,
                                ProyectoImagenRepo $proyectoImagenRepo)
    {
        $this->proyectoRepo = $proyectoRepo;
        $this->proyectoImagenRepo = $proyectoImagenRepo;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request)
    {
        $rows = $this->proyectoRepo->paginateProyectos($request);
        
        return view('admin.proyectos.list', compact('rows'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.proyectos.create');
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
        $slug_url = $this->proyectoRepo->SlugUrl($titulo);

        //GUARDAR DATOS
        $row = new Proyecto($request->all());
        $row->slug_url = $slug_url;
        $rowSave = $this->proyectoRepo->create($row, $request->all());

        //MENSAJE
        flash()->success('El registro se agregó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.proyectos.img.create', $rowSave->id);
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
        $row = $this->proyectoRepo->findOrFail($id);

        return view('admin.proyectos.edit', compact('row'));
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
        $row = $this->proyectoRepo->findOrFail($id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rules);

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $this->proyectoRepo->SlugUrl($titulo);

        //GUARDAR DATOS
        $row->slug_url = $slug_url;
        $this->proyectoRepo->update($row, $request->all());

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.proyectos.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $row = $this->proyectoRepo->findOrFail($id);
        $row->delete();       

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

    }


    /*
     * Cambiar estado de Publicar
     */
    public function publicar($id, Request $request)
    {
        //BUSCAR ID PARA ELIMINAR
        $post = $this->proyectoRepo->findOrFail($id);

        if($post->publicar == 0){
            $publicar = 1;
        }else{
            $publicar = 0;
        }

        $post->publicar = $publicar;
        $this->proyectoRepo->update($post, $request->all());

        $message = 'El registro se modificó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message,
                'estado'  => $publicar
            ]);
        }

        return redirect()->route('admin.proyectos.index');
    }



    /**
     * Fotos de Post
     *
     * @param  int  $id
     * @return Response
     */
    public function photosList($post)
    {
        $posts = $this->proyectoRepo->findOrFail($post);
        $photos = $this->proyectoImagenRepo->where('proyecto_id', $post)->orderBy('orden','asc')->get();

        return view('admin.proyecto-imagenes.list', compact('posts', 'photos'));
    }

    public function photosOrder($post, Request $request)
    {
        if($request->ajax())
        {
            $sortedval = $_POST['listPhoto'];
            try{
                foreach ($sortedval as $key => $sort){
                    $sortPhoto = ProyectoImagen::find($sort);
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
        $posts = $this->proyectoRepo->findOrFail($post);

        return view('admin.proyecto-imagenes.upload', compact('posts'));
    }

    public function photosStore($post, Request $request)
    {
        //CREAR CARPETA CON FECHA Y MOVER IMAGEN
        $this->proyectoRepo->CrearCarpeta();
        $ruta = "upload/".$this->proyectoRepo->FechaCarpeta();
        $archivo = $request->file('file');
        $imagen = $this->proyectoRepo->FileMove($archivo, $ruta);
        $imagen_carpeta = $this->proyectoRepo->FechaCarpeta();

        //GUARDAR DATOS
        $photo = new ProyectoImagen();
        $photo->imagen = $imagen;
        $photo->imagen_carpeta = $imagen_carpeta;
        $photo->proyecto_id = $post;
        $photo->save();
    }

    public function photosDelete($post, $id, Request $request)
    {
        $photo = $this->proyectoImagenRepo->findOrFail($id);
        $photo->delete();

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.proyectos.img.list', $post);
    }

}
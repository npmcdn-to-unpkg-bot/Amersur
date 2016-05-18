<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Admin\Video;
use Amersur\Repositories\Admin\VideoRepo;

class GalleryVideosController extends Controller {

    protected $rules = [
        'titulo' => 'required',
        'descripcion' => 'required|min:10|max:255',
        'imagen' => 'mimes:jpeg,jpg,png',
        'video' => 'required',
        'published_at' => 'required',
        'publicar' => 'required|in:1,0'
    ];

    protected $videoRepo;

    public function __construct(VideoRepo $videoRepo)
    {

        $this->videoRepo = $videoRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $posts = $this->videoRepo->findAndPaginate($request);

        return view('admin.videos.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        //CREAR CARPETA CON FECHA Y MOVER IMAGEN
        if($request->hasFile('imagen'))
        {
            $this->videoRepo->CrearCarpeta();
            $ruta = "upload/".$this->videoRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->videoRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->videoRepo->FechaCarpeta();
        }else{
            $imagen = "";
            $imagen_carpeta = "";
        }        

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $this->videoRepo->SlugUrl($titulo);
        $video = $request->input('video');

        //GUARDAR DATOS
        $post = new Video($request->all());
        $post->slug_url = $slug_url;
        $post->video = $video;
        $post->imagen = $imagen;
        $post->imagen_carpeta = $imagen_carpeta;
        $this->videoRepo->create($post, $request->all());

        //MENSAJE
        flash()->success('El registro se agregó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.gallery.video.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->videoRepo->findOrFail($id);

        return view('admin.videos.edit', compact('post'));
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
        $post = $this->videoRepo->findOrFail($id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rules);

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $this->videoRepo->SlugUrl($titulo);
        $video = $request->input('video');

        //VERIFICAR SI SUBIO IMAGEN
        if($request->hasFile('imagen'))
        {
            $this->videoRepo->CrearCarpeta();
            $ruta = "upload/".$this->videoRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->videoRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->videoRepo->FechaCarpeta();
        }else{
            $imagen = $request->input('imagen_actual');
            $imagen_carpeta = $request->input('imagen_actual_carpeta');
        }

        //GUARDAR DATOS
        $post->slug_url = $slug_url;
        $post->imagen = $imagen;
        $post->imagen_carpeta = $imagen_carpeta;
        $post->video = $video;
        $this->videoRepo->update($post, $request->except('imagen'));

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.gallery.video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $post = $this->videoRepo->findOrFail($id);
        $post->delete();       

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.post.index');
    }
    
}

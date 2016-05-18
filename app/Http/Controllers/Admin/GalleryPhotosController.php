<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Admin\Gallery;
use Amersur\Entities\Admin\GalleryPhoto;
use Amersur\Repositories\Admin\GalleryRepo;
use Amersur\Repositories\Admin\GalleryPhotoRepo;

class GalleryPhotosController extends Controller {

    protected $rules = [
        'titulo' => 'required',
        'slug_url' => 'required',
        'descripcion' => 'required|min:10|max:255',
        'contenido' => 'required',
        'imagen' => 'mimes:jpeg,jpg,png',
        'published_at' => 'required',
        'publicar' => 'required|in:1,0'
    ];

    protected $galleryRepo;
    protected $galleryPhotoRepo;

    public function __construct(GalleryRepo $galleryRepo,
                                GalleryPhotoRepo $galleryPhotoRepo)
    {

        $this->galleryRepo = $galleryRepo;
        $this->galleryPhotoRepo = $galleryPhotoRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $gallery = $this->galleryRepo->findAndPaginate($request);
        return view('admin.gallery-photo.list', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.gallery-photo.create');
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
            $this->galleryRepo->CrearCarpeta();
            $ruta = "upload/".$this->galleryRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->galleryRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->galleryRepo->FechaCarpeta();
        }else{
            $imagen = "";
            $imagen_carpeta = "";
        }        

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $request->input('slug_url');

        //GUARDAR DATOS
        $post = new Gallery($request->all());
        $post->slug_url = $slug_url;
        $post->imagen = $imagen;
        $post->imagen_carpeta = $imagen_carpeta;
        $post->user_id = Auth::user()->id;
        $this->galleryRepo->create($post, $request->all());

        //MENSAJE
        \Session::flash('mensaje', 'El registro se agregó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.gallery.photo.index');
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
        $gallery = $this->galleryRepo->findOrFail($id);

        return view('admin.gallery-photo.edit', compact('gallery'));
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
        $post = $this->galleryRepo->findOrFail($id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rules);

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $request->input('slug_url');
        
        //VERIFICAR SI SUBIO IMAGEN
        if($request->hasFile('imagen'))
        {
            $this->galleryRepo->CrearCarpeta();
            $ruta = "upload/".$this->galleryRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->galleryRepo->FileMove($archivo, $ruta)
;            $imagen_carpeta = $this->galleryRepo->FechaCarpeta();
        }else{
            $imagen = $request->input('imagen_actual');
            $imagen_carpeta = $request->input('imagen_actual_carpeta');
        }

        //GUARDAR DATOS
        $post->slug_url = $slug_url;
        $post->imagen = $imagen;
        $post->imagen_carpeta = $imagen_carpeta;
        $this->galleryRepo->update($post, $request->except('imagen'));

        //MENSAJE
        \Session::flash('mensaje', 'El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.gallery.photo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $post = $this->galleryRepo->findOrFail($id);
        $post->delete();       

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.gallery.photo.index');
    }

    /**
     * Generar URL a partir de Titulo de Noticia
     *
     * @param  int  $id
     * @return Response
     */
    public function slugUrl(Request $request)
    {
        $url = $this->galleryRepo->SlugUrl($request->input('ajaxTitulo'));

        if($request->ajax())
        {
            return response()->json([
                'url' => $url
            ]);
        }
    }

    /**
     * Lista de noticias Eliminadas
     */
    public function listsDeletes(Request $request)
    {
        $posts = $this->galleryRepo->findAndPaginateDeletes($request);
        return view('admin.gallery-photo.list-deletes', compact('posts'));
    }


    /**
     * Eliminacion completa de Noticia
     */
    public function destroyTotal($id, Request $request)
    {
        $post = $this->galleryRepo->findTrash($id);
        $post->forceDelete();

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.gallery.photo.listsDeletes');
    }


    /**
     * Restaurar noticia
     */
    public function restore($id, Request $request)
    {
        $post = $this->galleryRepo->findTrash($id);
        $post->restore();

        $message = 'El registro se restauró satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.gallery.photo.listsDeletes');
    }


    /**
     * Fotos de Post
     *
     * @param  int  $id
     * @return Response
     */
    public function photosList($post)
    {
        $posts = $this->galleryRepo->findOrFail($post);
        $photos = $this->galleryPhotoRepo->where('gallery_id', $post)->orderBy('orden','asc')->get();
        return view('admin.gallery-photo-list.list', compact('posts', 'photos'));
    }

    public function photosOrder($post, Request $request)
    {
        if($request->ajax())
        {
            $sortedval = $_POST['listPhoto'];
            try{
                foreach ($sortedval as $key => $sort){
                    $sortPhoto = GalleryPhoto::find($sort);
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
        $posts = $this->galleryRepo->findOrFail($post);
        return view('admin.gallery-photo-list.upload', compact('posts'));
    }

    public function photosStore($post, Request $request)
    {
        //CREAR CARPETA CON FECHA Y MOVER IMAGEN
        $this->galleryRepo->CrearCarpeta();
        $ruta = "upload/".$this->galleryRepo->FechaCarpeta();
        $archivo = $request->file('file');
        $imagen = $this->galleryRepo->FileMove($archivo, $ruta);
        $imagen_carpeta = $this->galleryRepo->FechaCarpeta();

        //GUARDAR DATOS
        $photo = new GalleryPhoto();
        $photo->imagen = $imagen;
        $photo->imagen_carpeta = $imagen_carpeta;
        $photo->gallery_id = $post;
        $photo->user_id = Auth::user()->id;
        $photo->save();
    }

    public function photosEdit($post, $id)
    {
        $posts = $this->galleryRepo->findOrFail($post);
        $photo = GalleryPhoto::whereId($id)->first();

        return view('admin.gallery-photo-list.edit', compact('posts', 'photo'));
    }

    public function photosUpdate($post, $id, Request $request)
    {
        $postPhoto = $this->galleryPhotoRepo->findOrFail($id);

        $ruleImg = [
            'imagen' => 'mimes:jpg,jpeg,png'
        ];

        //VALIDACION DE DATOS
        $this->validate($request, $ruleImg);

        //VARIABLES
        $titulo = $request->input('titulo');

        //VERIFICAR SI SUBIO IMAGEN
        if($request->hasFile('imagen'))
        {
            $this->galleryRepo->CrearCarpeta();
            $ruta = "upload/".$this->galleryRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->galleryRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->galleryRepo->FechaCarpeta();
        }else{
            $imagen = $request->input('imagen_actual');
            $imagen_carpeta = $request->input('imagen_actual_carpeta');
        }

        //GUARDAR DATOS
        $postPhoto->titulo = $titulo;
        $postPhoto->imagen = $imagen;
        $postPhoto->imagen_carpeta = $imagen_carpeta;
        $this->galleryPhotoRepo->update($postPhoto, $request->all());

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.gallery.photo.photosList', $post);
    }

    public function photosDelete($post, $id, Request $request)
    {        
        $photo = $this->galleryPhotoRepo->findOrFail($id);
        $photo->delete();

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.gallery.photo.photosList', $post);
    }
}

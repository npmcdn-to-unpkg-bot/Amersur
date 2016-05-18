<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Admin\Post;
use Amersur\Entities\Admin\PostPhoto;
use Amersur\Entities\Admin\PostHistory;
use Amersur\Repositories\Admin\PostCategoryRepo;
use Amersur\Repositories\Admin\PostRepo;
use Amersur\Repositories\Admin\PostHistoryRepo;
use Amersur\Repositories\Admin\PostOrderRepo;
use Amersur\Repositories\Admin\PostPhotoRepo;
use Amersur\Repositories\Admin\PostTagRepo;

class PostsController extends Controller {

    protected $rules = [
        'titulo' => 'required',
        'slug_url' => 'required',
        'descripcion' => 'required|min:10|max:255',
        'contenido' => 'required',
        'imagen' => 'mimes:jpeg,jpg,png',
        'categoria' => 'required',
        'orden' => 'required',
        'published_at' => 'required',
        'publicar' => 'required|in:1,0'
    ];

    protected $postCategoryRepo;
    protected $postRepo;
    protected $postHistoryRepo;
    protected $postOrderRepo;
    protected $postPhotoRepo;
    protected $postTagRepo;

    public function __construct(PostCategoryRepo $postCategoryRepo,
                                PostRepo $postRepo,
                                PostHistoryRepo $postHistoryRepo,
                                PostOrderRepo $postOrderRepo,
                                PostPhotoRepo $postPhotoRepo,
                                PostTagRepo $postTagRepo)
    {
        $this->postCategoryRepo = $postCategoryRepo;
        $this->postRepo = $postRepo;
        $this->postHistoryRepo = $postHistoryRepo;
        $this->postOrderRepo = $postOrderRepo;
        $this->postPhotoRepo = $postPhotoRepo;
        $this->postTagRepo = $postTagRepo;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request)
    {
        $posts = $this->postRepo->findAndPaginate($request);
        $category = $this->postCategoryRepo->all()->lists('titulo', 'id');
        return view('admin.post.list', compact('posts', 'category'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $category = $this->postpostCategoryRepo->all()->lists('titulo', 'id');
        $order = $this->postOrderRepo->all()->lists('titulo', 'id');
        $tags = $this->postTagRepo->all()->lists('titulo', 'id');
        $selected = [];
        return view('admin.post.create', compact('category', 'order', 'tags', 'selected'));
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
            $this->postRepo->CrearCarpeta();
            $ruta = "upload/".$this->postRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->postRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->postRepo->FechaCarpeta();
        }else{
            $imagen = "";
            $imagen_carpeta = "";
        }        

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $request->input('slug_url');
        $video = $request->input('video');
        $categoria = $request->input('categoria');
        $orden = $request->input('orden');

        //TAGS
        $tags=$request->input('tags');
        if($tags==""){ $union_tags=0; }
        elseif($tags<>""){ $union_tags=implode(",", $tags);}

        //GUARDAR DATOS
        $post = new Post($request->all());
        $post->slug_url = $slug_url;
        $post->video = $video;
        $post->category_id = $categoria;
        $post->post_order_id = $orden;
        $post->tags = '-0,'.$union_tags.',0-';
        $post->imagen = $imagen;
        $post->imagen_carpeta = $imagen_carpeta;
        $post->user_id = Auth::user()->id;
        $this->postRepo->create($post, $request->all());

        //MENSAJE
        flash()->success('El registro se agregó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.post.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepo->findOrFail($id);

        $tags = $post->tags;
        $tags = explode(",", $tags);
        $tags = $this->postTagRepo->findOrFail($tags);

        return view('admin.post.show', compact('post', 'tags'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepo->findOrFail($id);
        $category = $this->postCategoryRepo->all()->lists('titulo', 'id');
        $order = $this->postOrderRepo->all()->lists('titulo', 'id');

        $tags = $this->postTagRepo->all()->lists('titulo', 'id');
        $tags_select = $post->tags;
        $tags_select = explode(",", $tags_select);

        return view('admin.post.edit', compact('post', 'category', 'order', 'tags', 'tags_select'));
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
        $post = $this->postRepo->findOrFail($id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rules);

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $request->input('slug_url');
        $video = $request->input('video');
        $categoria = $request->input('categoria');
        $orden = $request->input('orden');

        //VERIFICAR SI SUBIO IMAGEN
        if($request->hasFile('imagen'))
        {
            $this->postRepo->CrearCarpeta();
            $ruta = "upload/".$this->postRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->postRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->postRepo->FechaCarpeta();
        }else{
            $imagen = $request->input('imagen_actual');
            $imagen_carpeta = $request->input('imagen_actual_carpeta');
        }

        //TAGS
        $tags=$request->input('tags');
        if($tags==""){ $union_tags=0; }
        elseif($tags<>""){ $union_tags=implode(",", $tags);}

        //GUARDAR DATOS
        $post->slug_url = $slug_url;
        $post->imagen = $imagen;
        $post->imagen_carpeta = $imagen_carpeta;
        $post->video = $video;
        $post->category_id = $categoria;
        $post->post_order_id = $orden;
        $post->tags = '-0,'.$union_tags.',0-';        
        $this->postRepo->update($post, $request->except('imagen'));

        $history = new PostHistory;
        $history->type = 'update';
        $history->post_id = $id;
        $history->user_id = Auth::user()->id;
        $history->save();

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.post.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $history = new PostHistory;
        $history->type = 'delete';
        $history->post_id = $id;
        $history->user_id = Auth::user()->id;
        $history->save();

        $post = $this->postRepo->findOrFail($id);
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


    /**
     * Generar URL a partir de Titulo de Noticia
     *
     * @param  int  $id
     * @return Response
     */
    public function slugUrl(Request $request)
    {
        $url = $this->postRepo->SlugUrl($request->input('ajaxTitulo'));

        if($request->ajax())
        {
            return response()->json([
                'url' => $url
            ]);
        }
    }


    /**
     * Historial de cambios de Noticia
     */
    public function history($id, Request $request)
    {
        $post = $this->postRepo->findOrFail($id);
        $posts = $this->postHistoryRepo->where('post_id', $id)->paginate();

        return view('admin.post.history', compact('post','posts'));
    }


    /**
     * Lista de noticias Eliminadas
     */
    public function listsDeletes(Request $request)
    {
        $posts = $this->postRepo->findAndPaginateDeletes($request);
        $category = $this->postCategoryRepo->all()->lists('titulo', 'id');
        return view('admin.post.list-deletes', compact('posts', 'category'));
    }


    /**
     * Eliminacion completa de Noticia
     */
    public function destroyTotal($id, Request $request)
    {
        $post = $this->postRepo->findTrash($id);
        $post->forceDelete();

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.post.listsDeletes');
    }


    /**
     * Restaurar noticia
     */
    public function restore($id, Request $request)
    {
        $history = new PostHistory;
        $history->type = 'restore';
        $history->post_id = $id;
        $history->user_id = Auth::user()->id;
        $history->save();

        $post = $this->postRepo->findTrash($id);
        $post->restore();

        $message = 'El registro se restauró satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.post.listsDeletes');
    }


    /**
     * Fotos de Post
     *
     * @param  int  $id
     * @return Response
     */
    public function photosList($post)
    {
        $posts = $this->postRepo->findOrFail($post);
        $photos = $this->postPhotoRepo->where('post_id', $post)->orderBy('orden','asc')->get();
        return view('admin.post-photos.list', compact('posts', 'photos'));
    }

    public function photosOrder($post, Request $request)
    {
        if($request->ajax())
        {
            $sortedval = $_POST['listPhoto'];
            try{

                $history = new PostHistory;
                $history->type = 'update';
                $history->post_id = $post;
                $history->descripcion = "Cambio de orden de fotos";
                $history->user_id = Auth::user()->id;
                $history->save();

                foreach ($sortedval as $key => $sort){
                    $sortPhoto = PostPhoto::find($sort);
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
        $posts = $this->postRepo->findOrFail($post);
        return view('admin.post-photos.upload', compact('posts'));
    }

    public function photosStore($post, Request $request)
    {
        //CREAR CARPETA CON FECHA Y MOVER IMAGEN
        $this->postRepo->CrearCarpeta();
        $ruta = "upload/".$this->postRepo->FechaCarpeta();
        $archivo = $request->file('file');
        $imagen = $this->postRepo->FileMove($archivo, $ruta);
        $imagen_carpeta = $this->postRepo->FechaCarpeta();

        //GUARDAR DATOS
        $photo = new PostPhoto();
        $photo->imagen = $imagen;
        $photo->imagen_carpeta = $imagen_carpeta;
        $photo->post_id = $post;
        $photo->user_id = Auth::user()->id;
        $photo->save();

        $history = new PostHistory;
        $history->type = 'update';
        $history->post_id = $post;
        $history->descripcion = "Carga de foto";
        $history->user_id = Auth::user()->id;
        $history->save();
    }

    public function photosEdit($post, $id)
    {
        $posts = $this->postRepo->findOrFail($post);
        $photo = PostPhoto::whereId($id)->first();

        return view('admin.post-photos.edit', compact('posts', 'photo'));
    }

    public function photosUpdate($post, $id, Request $request)
    {
        $postPhoto = $this->postPhotoRepo->findOrFail($id);

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
            $this->postRepo->CrearCarpeta();
            $ruta = "upload/".$this->postRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->postRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->postRepo->FechaCarpeta();
        }else{
            $imagen = $request->input('imagen_actual');
            $imagen_carpeta = $request->input('imagen_actual_carpeta');
        }

        //GUARDAR DATOS
        $postPhoto->titulo = $titulo;
        $postPhoto->imagen = $imagen;
        $postPhoto->imagen_carpeta = $imagen_carpeta;
        $this->postPhotoRepo->update($postPhoto, $request->all());

        $history = new PostHistory;
        $history->type = 'update';
        $history->post_id = $post;
        $history->descripcion = "Actualización de foto";
        $history->user_id = Auth::user()->id;
        $history->save();

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.post.photosList', $post);
    }

    public function photosDelete($post, $id, Request $request)
    {
        $history = new PostHistory;
        $history->type = 'update';
        $history->post_id = $post;
        $history->descripcion = "Eliminación de foto";
        $history->user_id = Auth::user()->id;
        $history->save();
        
        $photo = $this->postPhotoRepo->findOrFail($id);
        $photo->delete();

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.post.photosList', $post);
    }

}
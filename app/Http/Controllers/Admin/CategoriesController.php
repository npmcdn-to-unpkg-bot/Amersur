<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Admin\PostCategory;
use Amersur\Repositories\Admin\PostCategoryRepo;

class CategoriesController extends Controller {

    protected  $rules = [
        'titulo' => 'required',
        'publicar' => 'required|in:1,0'
    ];

    protected $categoryRepo;

    public function __construct(PostCategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request)
    {
        $categories = $this->categoryRepo->findAndPaginate($request);
        return view('admin.categories.list', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        //GUARDAR DATOS
        $category = new Category($request->all());
        $category->user_id = Auth::user()->id;
        $this->categoryRepo->create($category, $request->all());

        //MENSAJE
        \Session::flash('mensaje', 'El registro se agregó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.category.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepo->findOrFail($id);
        return View::make('admin.categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepo->findOrFail($id);
        return view('admin.categories.edit', compact('category'));
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
        $category = $this->categoryRepo->findOrFail($id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rules);

        //GUARDAR DATOS
        $category->user_id = Auth::user()->id;
        $this->categoryRepo->update($category, $request->all());

        //MENSAJE
        \Session::flash('mensaje', 'El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.category.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $post = $this->categoryRepo->findOrFail($id);
        $post->delete();       

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.category.index');
    }


    /**
     * Generar URL a partir de Titulo de Noticia
     *
     * @param  int  $id
     * @return Response
     */
    public function slugUrl(Request $request)
    {
        $url = $this->categoryRepo->SlugUrl($request->input('ajaxTitulo'));

        if($request->ajax())
        {
            return response()->json([
                'url' => $url
            ]);
        }
    }

}
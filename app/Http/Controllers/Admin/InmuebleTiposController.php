<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Amersur\InmuebleTipo;
use Amersur\Repositories\Amersur\InmuebleTipoRepo;

class InmuebleTiposController extends Controller {

    protected  $rules = [
        'titulo' => 'required'
    ];

    protected $inmuebleTipoRepo;

    /**
     * InmuebleTiposController constructor.
     * @param InmuebleTipoRepo $inmuebleTipoRepo
     */
    public function __construct(InmuebleTipoRepo $inmuebleTipoRepo)
    {
        $this->inmuebleTipoRepo = $inmuebleTipoRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = $this->inmuebleTipoRepo->findAndPaginate($request);

        return view('admin.inmueble-tipos.list', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.inmueble-tipos.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $this->inmuebleTipoRepo->SlugUrl($titulo);

        //GUARDAR DATOS
        $category = new InmuebleTipo($request->all());
        $category->slug_url = $slug_url;
        $this->inmuebleTipoRepo->create($category, $request->all());

        //MENSAJE
        flash()->success('El registro se agregó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.inmueble-tipos.index');
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
        $category = $this->inmuebleTipoRepo->findOrFail($id);

        return view('admin.inmueble-tipos.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        //BUSCAR ID
        $category = $this->inmuebleTipoRepo->findOrFail($id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rules);

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $this->inmuebleTipoRepo->SlugUrl($titulo);

        //GUARDAR DATOS
        $category->slug_url = $slug_url;
        $this->inmuebleTipoRepo->update($category, $request->all());

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.inmueble-tipos.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $post = $this->inmuebleTipoRepo->findOrFail($id);
        $post->delete();       

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.inmueble-tipos.index');
    }

}
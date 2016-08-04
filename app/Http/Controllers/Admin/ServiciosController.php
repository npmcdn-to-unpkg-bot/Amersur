<?php namespace Amersur\Http\Controllers\Admin;

use Amersur\Entities\Amersur\Servicio;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Amersur\ServicioRepo;

class ServiciosController extends Controller {

    protected  $rules = [
        'titulo' => 'required',
        'descripcion' => 'required',
        'contenido' => 'required',
        'publicar' => 'required|in:0,1'
    ];

    protected $servicioRepo;

    public function __construct(ServicioRepo $servicioRepo)
    {
        $this->servicioRepo = $servicioRepo;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request)
    {
        $rows = $this->servicioRepo->paginateServicios($request);
        
        return view('admin.servicios.list', compact('rows'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.servicios.create');
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
        $slug_url = $this->servicioRepo->SlugUrl($titulo);

        //GUARDAR DATOS
        $row = new Servicio($request->all());
        $row->slug_url = $slug_url;
        $this->servicioRepo->create($row, $request->all());

        //MENSAJE
        flash()->success('El registro se agregó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.servicios.index');
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
        $row = $this->servicioRepo->findOrFail($id);

        return view('admin.servicios.edit', compact('row'));
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
        $row = $this->servicioRepo->findOrFail($id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rules);

        //VARIABLES
        $titulo = $request->input('titulo');
        $slug_url = $this->servicioRepo->SlugUrl($titulo);

        //GUARDAR DATOS
        $row->slug_url = $slug_url;
        $this->servicioRepo->update($row, $request->all());

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.servicios.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $row = $this->servicioRepo->findOrFail($id);
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
        //BUSCAR ID
        $post = $this->servicioRepo->findOrFail($id);

        if($post->publicar == 0){
            $publicar = 1;
        }else{
            $publicar = 0;
        }

        $post->publicar = $publicar;
        $this->servicioRepo->update($post, $request->all());

        $message = 'El registro se modificó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message,
                'estado'  => $publicar
            ]);
        }

        return redirect()->route('admin.servicios.index');
    }


}
<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Amersur\Proyecto;
use Amersur\Repositories\Amersur\ProyectoRepo;

class ProyectosController extends Controller {

    protected  $rules = [
        'titulo' => 'required',
        'descripcion' => 'required',
        'imagen' => ''
    ];

    protected $proyectoRepo;

    public function __construct(ProyectoRepo $proyectoRepo)
    {
        $this->proyectoRepo = $proyectoRepo;
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

        //CREAR CARPETA CON FECHA Y MOVER IMAGEN
        if($request->hasFile('imagen'))
        {
            $this->proyectoRepo->CrearCarpeta();
            $ruta = "upload/".$this->proyectoRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->proyectoRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->proyectoRepo->FechaCarpeta();
        }else{
            $imagen = "";
            $imagen_carpeta = "";
        }

        //GUARDAR DATOS
        $row = new Proyecto($request->all());
        $row->imagen = $imagen;
        $row->imagen_carpeta = $imagen_carpeta;
        $this->proyectoRepo->create($row, $request->except('imagen'));

        //MENSAJE
        flash()->success('El registro se agregó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.proyectos.index');
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

        //VERIFICAR SI SUBIO IMAGEN
        if($request->hasFile('imagen'))
        {
            $this->proyectoRepo->CrearCarpeta();
            $ruta = "upload/".$this->proyectoRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->proyectoRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->proyectoRepo->FechaCarpeta();
        }else{
            $imagen = $request->input('imagen_actual');
            $imagen_carpeta = $request->input('imagen_actual_carpeta');
        }

        //GUARDAR DATOS
        $row->imagen = $imagen;
        $row->imagen_carpeta = $imagen_carpeta;
        $this->proyectoRepo->update($row, $request->except('imagen'));

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

}
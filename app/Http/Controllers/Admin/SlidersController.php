<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Admin\Slider;
use Amersur\Repositories\Admin\SliderRepo;

class SlidersController extends Controller {

    protected $rules = [
        'titulo' => 'required',
        'descripcion' => 'required',
        'moneda' => 'required',
        'precio' => 'required',
        'enlace' => 'required',
        'publicar' => 'required|in:1,0'
    ];

    protected $sliderRepo;

    public function __construct(SliderRepo $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $posts = $this->sliderRepo->findAndPaginate($request);

        return view('admin.sliders.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sliders.create');
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
            $this->sliderRepo->CrearCarpeta();
            $ruta = "upload/".$this->sliderRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->sliderRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->sliderRepo->FechaCarpeta();
        }else{
            $imagen = "";
            $imagen_carpeta = "";
        }

        //GUARDAR DATOS
        $post = new Slider($request->all());
        $post->imagen = $imagen;
        $post->imagen_carpeta = $imagen_carpeta;
        $this->sliderRepo->create($post, $request->except('imagen'));

        //MENSAJE
        flash()->success('El registro se agregó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.slider.index');
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
	 * GET /adminsliders/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $post = $this->sliderRepo->findOrFail($id);

        return view('admin.sliders.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /adminsliders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$post = $this->sliderRepo->findOrFail($id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rules);

        //VERIFICAR SI SUBIO IMAGEN
        if($request->hasFile('imagen'))
        {
            $this->sliderRepo->CrearCarpeta();
            $ruta = "upload/".$this->sliderRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->sliderRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->sliderRepo->FechaCarpeta();
        }else{
            $imagen = $request->input('imagen_actual');
            $imagen_carpeta = $request->input('imagen_actual_carpeta');
        }

        //GUARDAR DATOS
        $post->imagen = $imagen;
        $post->imagen_carpeta = $imagen_carpeta;
        $this->sliderRepo->update($post, $request->except('imagen'));

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.slider.index');
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
        $post = $this->sliderRepo->findOrFail($id);
        $post->delete();

        $message = 'El registro se eliminó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('admin.slider.index');
    }


    /*
     * Cambiar estado de Publicar
     */
    public function publicar($id, Request $request)
    {
        //BUSCAR ID PARA ELIMINAR
        $post = $this->sliderRepo->findOrFail($id);

        if($post->publicar == 0){
            $publicar = 1;
        }else{
            $publicar = 0;
        }

        $post->publicar = $publicar;
        $this->sliderRepo->update($post, $request->all());

        $message = 'El registro se modificó satisfactoriamente.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $message,
                'estado'  => $publicar
            ]);
        }

        return redirect()->route('admin.slider.index');
    }
    
}
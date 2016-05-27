<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Admin\History;
use Amersur\Repositories\Admin\HistoryRepo;

use Amersur\Entities\Amersur\Servicio;
use Amersur\Repositories\Amersur\ServicioRepo;

class ServiciosController extends Controller {

	protected $rules = [
		'titulo' => 'required',
		'proveedor' => 'required',
        'costo_tot_servicio' => 'numeric|min:1',
        'costo_por_kg' => 'numeric|min:1',
        'costo_serv_hra' => 'numeric|min:1',
        'peso_min' => 'numeric|min:1',
        'peso_max' => 'numeric|min:1',
        'moneda' => 'required',
        'pais' => 'string',
        'tiempo_min' => 'required|numeric',
        'tiempo_max' => 'required|numeric',
        'predeterminado' => 'required|in:0,1'
	];

    protected $historyRepo;
    protected $servicioRepo;

	protected $tabla = 'servicios';

    public function __construct(HistoryRepo $historyRepo,
                                ServicioRepo $servicioRepo)
	{
        $this->historyRepo = $historyRepo;
        $this->servicioRepo = $servicioRepo;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$posts = $this->servicioRepo->findAndPaginate($request);
				
		return view('admin.servicios.list', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $money = $this->moneyRepo->all()->lists('titulo', 'id');
        $provider = $this->providerRepo->all()->lists('titulo', 'id');
        $pais = $this->paisRepo->all()->lists('nombre', 'id');
		$selected = [];

		return view('admin.servicios.create', compact('money','selected','pais','provider'));
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
        $proveedor = $request->input('proveedor');
        $moneda = $request->input('moneda');
        $pais = $request->input('pais');
        $history = json_encode($request->except('_method','_token'));

		//GUARDAR DATOS
		$post = new Servicio($request->all());
        $post->provider_id = $proveedor;
        $post->money_id = $moneda;
        $post->pais_id = $pais;
		$post->user_id = Auth::user()->profile->id;
        $post->history = $history;
		$this->servicioRepo->create($post, $request->all());

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
        $money = $this->moneyRepo->all()->lists('titulo', 'id');
        $provider = $this->providerRepo->all()->lists('titulo', 'id');
        $pais = $this->paisRepo->all()->lists('nombre', 'id');
		$post = $this->servicioRepo->findOrFail($id);

		return view('admin.servicios.edit', compact('post','pais','provider','money'));
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
		$post = $this->servicioRepo->findOrFail($id);

		//VALIDACION DE DATOS
		$this->validate($request, $this->rules);

        //VARIABLES
        $proveedor = $request->input('proveedor');
        $moneda = $request->input('moneda');

		//GUARDAR DATOS
        $post->provider_id = $proveedor;
        $post->money_id = $moneda;
		$this->servicioRepo->update($post, $request->all());

		//GUARDAR HISTORIAL
		$history = new History;
		$this->historyRepo->saveHistory($history, $this->tabla, $id, $request, 'update');

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
		//GUARDAR HISTORIAL
		$history = new History;
		$this->historyRepo->saveHistory($history, $this->tabla, $id, $request, 'delete');

		//BUSCAR ID PARA ELIMINAR
		$post = $this->servicioRepo->findOrFail($id);
		$post->delete();

		$message = 'El registro se eliminó satisfactoriamente.';

		if($request->ajax())
		{
			return response()->json([
				'message' => $message
			]);
		}

		return redirect()->route('admin.servicios.index');
	}


	/**
	 * Historial de cambios del registro
	 */
	public function history($id)
	{
		$post = $this->servicioRepo->findOrFail($id);
		$posts = $this->historyRepo->findHistory($this->tabla, $id);

		return view('admin.servicios.history', compact('post','posts'));
	}

}
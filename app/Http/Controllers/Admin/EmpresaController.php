<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Admin\EmpresaRepo;

class EmpresaController extends Controller {

    protected $rules = [
        'contenido' => 'required'
    ];

    protected $empresaRepo;
    protected $id = 1;

    public function __construct(EmpresaRepo $empresaRepo)
    {
        $this->empresaRepo = $empresaRepo;
    }

	/**
	 * Show the form for editing the specified adminconfig.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
        $empresa = $this->empresaRepo->findOrFail($this->id);

		return view('admin.empresa.edit', compact('empresa'));
	}

	/**
	 * Update the specified adminconfig in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
        //OBTENER REGISTRO
        $contacto = $this->empresaRepo->findOrFail($this->id);

        //VALIDAR
        $this->validate($request, $this->rules);

        //GUARDAR DATOS
        $contacto->fill($request->all());
        $contacto->save();

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.empresa');
	}

}

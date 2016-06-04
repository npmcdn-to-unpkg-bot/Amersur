<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Admin\ContactoInfoRepo;

class ContactoController extends Controller {

    protected $rules = [
        'mapa' => 'required',
        'contenido' => ''
    ];

    private $contactoInfoRepo;
    private $id = 1;

    public function __construct(ContactoInfoRepo $contactoInfoRepo)
    {
        $this->contactoInfoRepo = $contactoInfoRepo;
    }

	/**
	 * Show the form for editing the specified adminconfig.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		$contacto = $this->contactoInfoRepo->findOrFail($this->id);

		return view('admin.contacto.edit', compact('contacto'));
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
        $contacto = $this->contactoInfoRepo->findOrFail($this->id);

        //VALIDAR
        $this->validate($request, $this->rules);

        //GUARDAR DATOS
        $contacto->fill($request->all());
        $contacto->save();

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.contacto');
	}

}

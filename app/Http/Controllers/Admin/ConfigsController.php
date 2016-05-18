<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Admin\ConfigurationRepo;

class ConfigsController extends Controller {

    protected $rules = [
        'titulo' => 'required',
        'email' => 'required',
        'dominio' => 'required',
        'description' => 'required|min:10|max:255',
        'keywords' => 'required'
    ];

    private $configurationRepo;
    private $id = 1;

    public function __construct(ConfigurationRepo $configurationRepo)
    {
        $this->configurationRepo = $configurationRepo;
    }

	/**
	 * Show the form for editing the specified adminconfig.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		$config = $this->configurationRepo->findOrFail($this->id);

		return view('admin.config.edit', compact('config'));
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
        $config = $this->configurationRepo->findOrFail($this->id);

        //VALIDAR
        $this->validate($request, $this->rules);

        //GUARDAR DATOS
        $config->fill($request->all());
        $config->save();

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.config');
	}

}

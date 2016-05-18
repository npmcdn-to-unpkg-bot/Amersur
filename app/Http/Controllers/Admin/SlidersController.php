<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Admin\Slider;
use Amersur\Repositories\Admin\SliderRepo;

class SlidersController extends Controller {

    protected $sliderRepo;

    public function __construct(SliderRepo $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }

	/**
	 * Show the form for editing the specified resource.
	 * GET /adminsliders/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
        $post = Slider::whereId(1)->first();

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
		$postPhoto = $this->sliderRepo->findOrFail($id);

        $rules = [
            'header' => 'string',
            'body' => 'string',
            'footer' => 'string'
        ];

        //VALIDACION DE DATOS
        $this->validate($request, $rules);

        //GUARDAR DATOS
        $this->sliderRepo->update($postPhoto, $request->all());

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.slider.edit', 1);
	}
}
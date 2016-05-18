<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Admin\CompanyRepo;
use Amersur\Repositories\Admin\SocialMediaRepo;

class CompanyController extends Controller {

    protected $rulesUs = [
        'contenido' => 'required'
    ];

    protected $rulesSocial = [
        'facebook'  => 'url',
        'google'    => 'url',
        'pinterest' => 'url',
        'skype'     => 'string',
        'tumblr'    => 'url',
        'twitter'   => 'url',
        'youtube'   => 'url',
        'whatsapp'  => 'string'
    ];

    protected $companyRepo;
    protected $socialMediaRepo;
    private $id = 1;

    public function __construct(CompanyRepo $companyRepo,
                                SocialMediaRepo $socialMediaRepo)
    {

        $this->companyRepo = $companyRepo;
        $this->socialMediaRepo = $socialMediaRepo;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function usEdit()
    {
        $company = $this->companyRepo->findOrFail($this->id);

        return view('admin.company.edit', compact('company'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function usUpdate(Request $request)
    {
        //BUSCAR ID
        $post = $this->companyRepo->findOrFail($this->id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rulesUs);

        //VERIFICAR SI SUBIO IMAGEN
        if($request->hasFile('imagen'))
        {
            $this->companyRepo->CrearCarpeta();
            $ruta = "upload/".$this->companyRepo->FechaCarpeta();
            $archivo = $request->file('imagen');
            $imagen = $this->companyRepo->FileMove($archivo, $ruta);
            $imagen_carpeta = $this->companyRepo->FechaCarpeta();
        }else{
            $imagen = $request->input('imagen_actual');
            $imagen_carpeta = $request->input('imagen_actual_carpeta');
        }

        //GUARDAR DATOS
        $post->imagen = $imagen;
        $post->imagen_carpeta = $imagen_carpeta;
        $this->companyRepo->update($post, $request->except('imagen'));

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.company.us.edit');
    }


    public function socialEdit()
    {
        $social = $this->socialMediaRepo->findOrFail($this->id);

        return view('admin.company.social', compact('social'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function socialUpdate(Request $request)
    {
        //BUSCAR ID
        $post = $this->socialMediaRepo->findOrFail($this->id);

        //VALIDACION DE DATOS
        $this->validate($request, $this->rulesSocial);

        //GUARDAR DATOS
        $this->socialMediaRepo->update($post, $request->all());

        //MENSAJE
        flash()->success('El registro se actualizó satisfactoriamente.');

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.company.social.edit');
    }

}
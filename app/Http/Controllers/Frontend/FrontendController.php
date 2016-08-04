<?php namespace Amersur\Http\Controllers\Frontend;

use Amersur\Repositories\Amersur\ServicioRepo;
use Illuminate\Http\Request;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Admin\ContactoInfoRepo;
use Amersur\Repositories\Admin\EmpresaRepo;
use Amersur\Repositories\Amersur\InmuebleRepo;
use Amersur\Repositories\Amersur\InmuebleTipoRepo;
use Amersur\Repositories\Amersur\ProyectoRepo;
use Amersur\Repositories\Admin\SliderRepo;

use Amersur\Entities\Admin\Configuration;
use Amersur\Entities\Admin\ContactoMensaje;

use Amersur\Traits\CapchaTrait;

class FrontendController extends Controller {

    use CapchaTrait;

    protected $contactoInfoRepo;
    protected $empresaRepo;
    protected $inmuebleRepo;
    protected $inmuebleTipoRepo;
    protected $proyectoRepo;
    protected $servicioRepo;
    protected $sliderRepo;

    public function __construct(ContactoInfoRepo $contactoInfoRepo,
                                EmpresaRepo $empresaRepo,
                                InmuebleRepo $inmuebleRepo,
                                InmuebleTipoRepo $inmuebleTipoRepo,
                                ProyectoRepo $proyectoRepo,
                                ServicioRepo $servicioRepo,
                                SliderRepo $sliderRepo)
    {
        $this->contactoInfoRepo = $contactoInfoRepo;
        $this->empresaRepo = $empresaRepo;
        $this->inmuebleRepo = $inmuebleRepo;
        $this->inmuebleTipoRepo = $inmuebleTipoRepo;
        $this->proyectoRepo = $proyectoRepo;
        $this->servicioRepo = $servicioRepo;
        $this->sliderRepo = $sliderRepo;
    }

    public function index()
    {
        $inmuebles = $this->inmuebleRepo->frontPaginateInmuebles();
        $tipos = $this->inmuebleTipoRepo->all()->lists('titulo','id');
        $slider = $this->sliderRepo->where('publicar', 1)->get();

        return view('frontend.index', compact('inmuebles','tipos','slider'));
	}

    public function nosotros()
    {
        $nosotros = $this->empresaRepo->findOrFail(1);

        return view('frontend.nosotros', compact('nosotros'));
    }

    //INMUEBLES
    public function inmuebles(Request $request)
    {
        $tipos = $this->inmuebleTipoRepo->all()->lists('titulo','id');
        $inmuebles = $this->inmuebleRepo->buscar($request);

        if($request->get('t') == 4){
            return redirect()->route('frontend.proyectos');
        }else{
            return view('frontend.inmuebles', compact('inmuebles','tipos'));
        }
    }

    //INMUEBLES SELECCIONADO
    public function inmueble($id, $url)
    {
        $inmueble = $this->inmuebleRepo->findOrFail($id);

        return view('frontend.inmuebles-nota', compact('inmueble'));
    }

    //PROYECTOS
    public function proyectos()
    {
        $proyectos = $this->proyectoRepo->frontPaginateProyectos();

        return view('frontend.proyectos', compact('proyectos'));
    }

    //PROYECTO SELECCIONADO
    public function proyecto($id, $url)
    {
        $proyecto = $this->proyectoRepo->findOrFail($id);

        return view('frontend.proyectos-nota', compact('proyecto'));
    }

    //SERVICIOS
    public function servicios()
    {
        $rows = $this->servicioRepo->frontPaginateServicios();

        return view('frontend.servicios', compact('rows'));
    }

    //PROYECTO SELECCIONADO
    public function servicio($id, $url)
    {
        $row = $this->servicioRepo->findOrFail($id);

        return view('frontend.servicios-nota', compact('row'));
    }

    //CONTACTO
    public function getContacto()
    {
        $contacto = $this->contactoInfoRepo->findOrFail(1);

        return view('frontend.contacto', compact('contacto'));
    }

    public function postContacto(Request $request)
    {
        //CONTACTO
        $contacto = Configuration::whereId(1)->first();

        //REGLAS
        $data = [
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'mensaje' => e($request->input('mensaje')),
            'asunto' => $request->input('asunto')
        ];

        $rules = [
            'nombre' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required',
            'asunto' => 'required',
            'g-recaptcha-response' => 'required'
        ];

        //VALIDACION
        $this->validate($request, $rules);

        //VALIDACION DE CAPTCHA
        if($this->captchaCheck() == false)
        {
            return redirect()->back()
                ->withErrors(['Error de captcha'])
                ->withInput();
        }

        //GUARDAR EN BD
        $contMensaje = new ContactoMensaje($request->all());
        $contMensaje->type = 'contacto';
        $contMensaje->save();

        //DATOS PARA ENVIO DE EMAIL
        $fromEmail = $data['email'];
        $fromNombre = $data['nombre'];
        $toEmail = $contacto->email;
        $toNombre = 'Amersur';
        $asunto = $data['asunto'];

        //ENVIO DE EMAIL
        \Mail::send('emails.frontend.contacto', $data, function($message) use ($fromNombre, $fromEmail, $toNombre, $toEmail, $asunto){
            $message->to($toEmail, $toNombre);
            $message->from($fromEmail, $fromNombre);
            $message->subject('Amersur - '. $asunto);
        });

        $mensaje = 'Tu mensaje ha sido enviado.';

        if($request->ajax())
        {
            return response()->json([
                'message' => $mensaje
            ]);
        }
    }

}

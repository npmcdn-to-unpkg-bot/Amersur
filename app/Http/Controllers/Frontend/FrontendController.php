<?php namespace Amersur\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Amersur\Http\Controllers\Controller;

use Amersur\Repositories\Admin\ContactoInfoRepo;
use Amersur\Repositories\Amersur\InmuebleRepo;
use Amersur\Repositories\Amersur\InmuebleTipoRepo;
use Amersur\Repositories\Admin\SliderRepo;

use Amersur\Entities\Admin\Configuration;
use Amersur\Entities\Admin\ContactoMensaje;

use Amersur\Traits\CapchaTrait;

class FrontendController extends Controller {

    use CapchaTrait;

    protected $contactoInfoRepo;
    protected $inmuebleRepo;
    protected $inmuebleTipoRepo;
    protected $sliderRepo;

    public function __construct(ContactoInfoRepo $contactoInfoRepo,
                                InmuebleRepo $inmuebleRepo,
                                InmuebleTipoRepo $inmuebleTipoRepo,
                                SliderRepo $sliderRepo)
    {
        $this->contactoInfoRepo = $contactoInfoRepo;
        $this->inmuebleRepo = $inmuebleRepo;
        $this->inmuebleTipoRepo = $inmuebleTipoRepo;
        $this->sliderRepo = $sliderRepo;
    }

    public function index()
    {
        $inmuebles = $this->inmuebleRepo->where('publicar', 1)->orderBy('published_at','desc')->paginate(6);
        $tipos = $this->inmuebleTipoRepo->all()->lists('titulo','id');
        $slider = $this->sliderRepo->where('publicar', 1)->get();

        return view('frontend.index', compact('inmuebles','tipos','slider'));
	}

    //INMUEBLES
    public function inmuebles(Request $request)
    {
        $tipos = $this->inmuebleTipoRepo->all()->lists('titulo','id');
        $inmuebles = $this->inmuebleRepo->buscar($request);

        return view('frontend.inmuebles', compact('inmuebles','tipos'));
    }

    //INMUEBLES SELECCIONADO
    public function inmueble($id, $url)
    {
        $inmueble = $this->inmuebleRepo->findOrFail($id);

        return view('frontend.inmuebles-nota', compact('inmueble'));
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
            'mensaje' => e($request->input('mensaje'))
        ];

        $rules = [
            'nombre'  => 'required',
            'email'   => 'required|email',
            'mensaje' => 'required',
            'g-recaptcha-response'  => 'required'
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

        //ENVIO DE EMAIL
        \Mail::send('emails.frontend.contacto', $data, function($message) use ($fromNombre, $fromEmail, $toEmail, $toNombre){
            $message->to($toEmail, $toNombre);
            $message->from($fromEmail, $fromNombre);
            $message->subject('Amersur - Contacto');
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

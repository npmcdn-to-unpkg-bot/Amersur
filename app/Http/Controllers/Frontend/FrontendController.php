<?php namespace Amersur\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\Admin\Configuration;
use Amersur\Entities\Admin\ContactoMensaje;

use Amersur\Traits\CapchaTrait;

class FrontendController extends Controller {

    use CapchaTrait;

    public function index()
    {

	}

    //CONTACTO
    public function getContacto()
    {
        return view('frontend.contacto');
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

@extends('layouts.admin')

{{-- */
$mensaje_fecha = date_format(new DateTime($mensaje->created_at), 'd/m/Y H:i');
$mensaje_nombre = $mensaje->nombre.' '.$mensaje->apellidos;
$mensaje_email = $mensaje->email;
$mensaje_telefono = $mensaje->telefono;
$mensaje_telefono_wh = $mensaje->telefono_whatsapp;
$mensaje_asunto = $mensaje->asunto;
$mensaje_mensaje = $mensaje->mensaje;
/* --}}

@section('contenido_header')
@stop

@section('contenido_admin_title')
    {!! Request::is('admin/contacto/sugerencias*') ? 'Sugerencias' : 'Mensajes de Contacto' !!}
@stop

@section('contenido_admin')
<div class="row">
	<!--row starts-->
	<div class="col-lg-12">

        <!--basic form starts-->
		<div class="portlet box blue-hoki">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>{!! Request::is('admin/contacto/sugerencias*') ? 'Sugerencias' : 'Mensajes de Contacto' !!}
                </div>
            </div>

			<div class="portlet-body">

                <form class="form-horizontal">
                    <div class="form-body">
                        <h2 class="margin-bottom-20"> {{ $mensaje_nombre }} </h2>
                        <h3 class="form-section">Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nombre:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                             {{ $mensaje->nombre }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Apellidos:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                             {{ $mensaje->apellidos }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Email:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                             {{ $mensaje_email }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Fecha de Envío:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                             {{ $mensaje_fecha }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Teléfono:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                             {{ $mensaje_telefono }} @if($mensaje_telefono_wh == 1)<i class="fa fa-whatsapp"></i> @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Mensaje</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Asunto:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">{{ $mensaje_asunto }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <p class="form-control-static">
                                             {{ $mensaje_mensaje }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="{{ route('admin.contacto.mensajes.index') }}" class="btn btn-responsive default btn-md">Ver mensajes</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </form>

			</div>
		</div>

	</div>
	<!--md-6 ends-->

</div>

@stop

@section('contenido_footer')
@stop
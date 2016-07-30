@extends('layouts.admin')

@section('contenido_admin_title')
    {!! Request::is('admin/contacto/sugerencias*') ? 'Sugerencias' : 'Mensajes de Contacto' !!}
@stop

@section('contenido_header')
{!! HTML::style('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css') !!}
@stop

@section('contenido_admin')

	<div class="row">
		<div class="col-lg-12">

			<div class="portlet box blue-hoki">
				
				<div class="portlet-title">
					<div class="caption">
                        <i class="fa fa-globe"></i>Registros
                    </div>
				</div>

				<div class="portlet-body">

                    <div class="table-toolbar">

                        <div id="progressbar" class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>

                        @include('flash::message')

                        <div id="mensajeAjax" class="alert alert-dismissable"></div>
                        
                    </div>

                    {!! Form::model(Request::all(), ['route' => 'admin.contacto.mensajes.index', 'method' => 'GET']) !!}

                        <table class="table table-striped table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Leído</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-8">
                                        <div class="input-group date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                            <div class="input-group margin-bottom-5">
                                                {!! Form::text('from', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'De']) !!}
                                            </div>
                                            <div class="input-group ">
                                                {!! Form::text('to', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'A']) !!}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        {!! Form::select('leido', ['' => 'Seleccionar', '0' => 'No leído', '1' => 'Leído'], null, ['class' => 'form-control input-sm']) !!}
                                    </td>
                                    <td class="text-center col-md-2">
                                        {!! Form::button('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}

                                        <a href="{!! route('admin.contacto.mensajes.index') !!}" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    {!! Form::close() !!}

                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Asunto</th>
                                <th class="text-center">Leído</th>
                                <th class="text-center">Enviado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mensajes as $item)
                            {{-- */
                            $mensaje_fecha = date_format(new DateTime($item->created_at), 'd/m/Y H:i');
                            $mensaje_nombre = $item->nombre.' '.$item->apellidos;
                            $mensaje_email = $item->email;
                            $mensaje_telefono = $item->telefono;
                            $mensaje_telefono_wh = $item->telefono_whatsapp;
                            $mensaje_asunto = $item->asunto;
                            /* --}}
                            <tr data-id="{{ $item->id }}" data-title="{{ $mensaje_nombre }}">
                                <td>{{ $mensaje_nombre }}</td>
                                <td>{{ $mensaje_asunto }}</td>
                                <td class="text-center">{!! $item->leido ? '<span class="label label-success">Leído</span>' : '<span class="label label-danger">No leído</span>' !!}</td>
                                <td class="text-center">{{ $mensaje_fecha  }}</td>
                                <td class="text-center">
                                    <a title="Ver mensaje" href="{{ route('admin.contacto.mensajes.show', $item->id) }}" class="btn default btn-xs blue"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">Total de registros: {{ $mensajes->total() }}</div>
                        </div>

                        <div class="col-md-7 col-sm-12">
                            <div class="pull-right dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                {!! $mensajes->appends(Request::all())->render() !!}
                            </div>

                        </div>

                    </div>

				</div>
			</div>
		</div>
	</div>

@endsection

@section('contenido_footer')

{!! HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-daterangepicker/moment.min.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') !!}

{!! HTML::script('assets/admin/pages/scripts/components-pickers.js') !!}

<script>
$(document).on("ready", function(){
    ComponentsPickers.init();
    $('#mensajeAjax, #delete, #progressbar').hide();
});
</script>

@endsection
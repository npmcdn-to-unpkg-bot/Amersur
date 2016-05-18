@extends('layouts.admin')

@section('contenido_header')
{{-- SELECT 2 --}}
{!! HTML::style('assets/global/plugins/select2/css/select2.min.css') !!}
{!! HTML::style('assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}
@stop

@section('contenido_admin_title')
    Servicios - Editar
@stop

@section('contenido_admin')
<div class="row">
	<!--row starts-->
	<div class="col-lg-12">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

		<!--basic form starts-->
		<div class="portlet box blue-hoki">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>Servicios - Editar
                </div>
            </div>

			<div class="portlet-body form">
				{!! Form::model($post, ['route' => ['admin.servicios.update', $post->id], 'method' => 'PUT', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                <div class="form-group">
                    {!! Form::label('titulo', 'Titulo', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('titulo', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('proveedor', 'Proveedor', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-3">
                        {!! Form::select('proveedor', ['' => 'Seleccionar'] + $provider, $post->provider_id, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('costo_tot_servicio', 'Costo Servicio', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('costo_tot_servicio', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('costo_por_kg', 'Costo por KG', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('costo_por_kg', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('costo_serv_hra', 'Costo Servicio x Hora', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('costo_serv_hra', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('peso_min', 'Peso Mínimo', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('peso_min', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('peso_max', 'Peso Máximo', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('peso_max', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('pais', 'Pais', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::select('pais', ['' => 'Seleccionar'] + $pais, $post->pais_id, ['class' => 'form-control select2']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('moneda', 'Moneda', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-3">
                        {!! Form::select('moneda', ['' => 'Seleccionar'] + $money, $post->money_id, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('tiempo_min', 'Tiempo Mínimo', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('tiempo_min', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('tiempo_max', 'Tiempo Máximo', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('tiempo_max', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('predeterminado', 'Predeterminao', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        <div class="radio-list">
                            <label class="radio-inline">
                                {!! Form::radio('predeterminado', '1', null,  ['id' => 'publicar']) !!}
                                Si
                            </label>
                            <label class="radio-inline">
                                {!! Form::radio('predeterminado', '0', null,  ['id' => 'publicar']) !!}
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Form actions -->
                <div class="form-group">
                    <div class="col-md-12 text-right">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                        <a href="{{ route('admin.servicios.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                    </div>
                </div>

				{!! Form::close() !!}
			</div>
		</div>

	</div>
	<!--md-6 ends-->

</div>
@stop

@section('contenido_footer')
{{-- SELECT 2 --}}
{!! HTML::script('assets/global/plugins/select2/js/select2.full.min.js') !!}
{!! HTML::script('assets/pages/scripts/components-select2.js') !!}
@stop
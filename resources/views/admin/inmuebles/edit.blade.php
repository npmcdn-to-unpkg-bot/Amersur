@extends('layouts.admin')

@section('contenido_header')
{!! HTML::style('assets/global/plugins/fancybox/jquery.fancybox.css') !!}

{{-- DATETIME PICKER --}}
{!! HTML::style('assets/global/plugins/datetimepicker/jquery.datetimepicker.css') !!}

{{-- SELECT 2 --}}
{!! HTML::style('assets/global/plugins/select2/css/select2.min.css') !!}
{!! HTML::style('assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}
@stop

@section('contenido_admin_title')
    Productos - Editar
@stop

@section('contenido_admin')
<div class="row">
	<!--row starts-->
	<div class="col-lg-12">

        <div class="row">

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

            {!! Form::model($post, ['route' => ['admin.inmuebles.update', $post->id], 'method' => 'PUT', 'files' => 'true', 'id' => 'formRegister']) !!}

                <div class="col-md-6">

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Descripción del Producto
                            </div>
                        </div>

                        <div class="portlet-body form">

                            <div class="form-body">

                                <div class="form-group">
                                    {!! Form::label('titulo', 'Titulo') !!}
                                    {!! Form::text('titulo', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('descripcion', 'Descripción') !!}
                                    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => '3',
                                    'onkeydown' => 'limitText(this.form.descripcion,this.form.countdown,220);',
                                    'onkeyup' => 'limitText(this.form.descripcion,this.form.countdown,220);']) !!}
                                    <span class="help-block">Caracteres permitidos:
                                        <strong>
                                            <input name="countdown" type="text" style="border:none; background:none;" value="220" size="3" readonly id="countdown">
                                        </strong>
                                    </span>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('contenido', 'Contenido') !!}
                                    {!! Form::textarea('contenido', null, ['class' => 'form-control ckeditor_full']) !!}
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Atributos
                            </div>
                        </div>

                        <div class="portlet-body form">

                            <div class="form-horizontal">

                                <div class="form-body">

                                    <div class="form-group">
                                        {!! Form::label('precio', 'Precio', ['class' => 'col-md-2 control-label']) !!}
                                        <div class="col-md-5">
                                            {!! Form::select('moneda', ['' => 'Seleccionar'] + $money, $post->money_id, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!! Form::text('precio', null, ['id' => 'precio', 'class' => 'form-control', 'placeholder' => 'Precio de producto']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('categoria', 'Categoría', ['class' => 'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            {!! Form::select('categoria', ['' => 'Seleccionar'] + $category, $post->category_id, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Características</div></div>

                        <div class="portlet-body form">

                            <div class="form-horizontal">

                                <div class="form-body">

                                    <div class="form-group">
                                        {!! Form::label('peso_gr', 'Peso GR', ['class' => 'col-md-2 control-label']) !!}
                                        <div class="col-md-5">
                                            {!! Form::text('peso_gr', null, ['class' => 'form-control', 'placeholder' => 'Peso GR']) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Opciones
                            </div>
                        </div>

                        <div class="portlet-body form">

                            <div class="form-horizontal">

                                <div class="form-body">

                                    <div class="form-group">
                                        {!! Form::label('opciones', 'Opciones', ['class' => 'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    {!! Form::radio('opciones', '0', $post->normal, ['id' => 'normal']) !!}
                                                    Normal
                                                </label>
                                                <label class="radio-inline">
                                                    {!! Form::radio('opciones', '1', $post->destacado, ['id' => 'destacado']) !!}
                                                    Destacado
                                                </label>
                                                <label class="radio-inline">
                                                    {!! Form::radio('opciones', '2', $post->oferta, ['id' => 'oferta']) !!}
                                                    Oferta
                                                </label>
                                            </div>
                                        </div>
                                        @if($post->oferta == 1)
                                            <div class="col-md-5" id="oferta_precio">
                                                {!! Form::text('oferta_precio', null, ['class' => 'form-control', 'placeholder' => 'Precio de oferta']) !!}
                                            </div>
                                        @else
                                            <div class="col-md-5" id="oferta_precio">
                                                {!! Form::text('oferta_precio', null, ['class' => 'form-control', 'placeholder' => 'Precio de oferta']) !!}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('publicar', 'Publicar', ['class' => 'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    {!! Form::radio('publicar', '1', null,  ['id' => 'publicar']) !!}
                                                    Si
                                                </label>
                                                <label class="radio-inline">
                                                    {!! Form::radio('publicar', '0', null,  ['id' => 'publicar']) !!}
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('published_at', 'Fecha de publicación', ['class' => 'col-md-4 control-label']) !!}
                                        <div class="col-md-8">
                                            {!! Form::text('published_at', null, ['class' => 'form-control datetimepicker']) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Gastos Operativos
                            </div>
                        </div>

                        <div class="portlet-body form">

                            <div class="form-horizontal">

                                <div class="form-body">

                                    <div class="form-group">
                                        {!! Form::label('logistica_origen', 'Logística Origen', ['class' => 'col-md-4 control-label']) !!}
                                        <div class="col-md-8">
                                            {!! Form::select('logistica_origen', ['' => 'Seleccionar'] + $services, $post->logistica_origen, ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('logistica_destino', 'Logística Destino', ['class' => 'col-md-4 control-label']) !!}
                                        <div class="col-md-8">
                                            {!! Form::select('logistica_destino', ['' => 'Seleccionar'] + $services, $post->logistica_destino, ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('transporte_origen', 'Transporte Origen', ['class' => 'col-md-4 control-label']) !!}
                                        <div class="col-md-8">
                                            {!! Form::select('transporte_origen', ['' => 'Seleccionar'] + $services, $post->transporte_origen, ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('transporte_destino', 'Transporte Destino', ['class' => 'col-md-4 control-label']) !!}
                                        <div class="col-md-8">
                                            {!! Form::select('transporte_destino', ['' => 'Seleccionar'] + $services, $post->transporte_destino, ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Gastos de Envío</div></div>

                        <div class="portlet-body form">

                            <div class="form-horizontal">

                                <div class="form-body">

                                    <div class="form-group">
                                        {!! Form::label('gastos_envio', 'Proveedor', ['class' => 'col-md-4 control-label']) !!}
                                        <div class="col-md-8">
                                            {!! Form::select('gastos_envio', ['' => 'Seleccionar'] + $services, $post->gastos_envio, ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Vista previa de Costos</div></div>

                        <div class="portlet-body form">

                            <div class="form-horizontal">

                                <div class="form-body">

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <a id="calcular_costos" href="javascipt:;" class="btn btn-primary btn-block">Calcular costos</a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            {{--*/
                                            $precio_costo = $post->precioCosto($post->money_id, $post->precio);
                                            $utilidades = $post->utilidades($precio_costo);
                                            $gastos_operativos = $post->gastosOperativos($post->peso_gr, $post->logistica_origen, $post->logistica_destino, $post->transporte_origen, $post->transporte_destino);
                                            $costos_envio = $post->costosEnvio($post->peso_gr, $post->gastos_envio);
                                            $impuesto = $post->impuesto($gastos_operativos, $precio_costo, $utilidades, $costos_envio);
                                            $precio_venta = $post->precioVenta($precio_costo, $utilidades, $gastos_operativos, $costos_envio, $impuesto);
                                            $precio_oferta = $post->precioOferta($post->oferta, $post->oferta_precio, $precio_venta);
                                            /*--}}
                                            <ul>
                                                <li><h4>Precio Costo: <strong>S/. <span id="calculo_precio_costo">{{ $precio_costo }}</span></strong></h4></li>
                                                <li><h4>Utilidad: <strong>S/. <span id="calculo_utilidad">{{ $utilidades }}</span></strong></h4></li>
                                                <li><h4>Gastos Operativos: <strong>S/. <span id="calculo_gastos_operativos">{{ $gastos_operativos }}</span></strong></h4></li>
                                                <li><h4>Costo de Envío: <strong>S/. <span id="calculo_gastos_envio">{{ $costos_envio }}</span></strong></h4></li>
                                                <li><h4>Impuesto: <strong>S/. <span id="calculo_impuesto">{{ $impuesto }}</span></strong></h4></li>
                                                <li><h4>Precio Venta: <strong>S/. <span id="calculo_precio_venta">{{ $precio_venta }}</span></strong></h4></li>
                                                <li><h4>Precio Oferta: <strong>S/. <span id="calculo_precio_oferta">{{ $precio_oferta }}</span></strong></h4></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar cambios', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                            <a href="{{ route('admin.inmuebles.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                        </div>
                    </div>

                </div>

            {!! Form::close() !!}

        </div>

	</div>
	<!--md-6 ends-->

</div>
@stop

@section('contenido_footer')
{{-- CKEDITOR --}}
{!! HTML::script('assets/global/plugins/ckeditor/ckeditor.js') !!}
{!! HTML::script('assets/global/plugins/ckeditor/adapters/jquery.js') !!}
{!! HTML::script('assets/admin/pages/scripts/ckeditor.js') !!}

{{-- DATETIME PICKER --}}
{!! HTML::script('assets/global/plugins/datetimepicker/jquery.datetimepicker.js') !!}
{!! HTML::script('assets/admin/pages/scripts/datetime.js') !!}

{{-- FANCYBOX --}}
{!! HTML::script('assets/global/plugins/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}
{!! HTML::script('assets/global/plugins/fancybox/jquery.fancybox.js') !!}
{!! HTML::script('assets/admin/pages/scripts/fancybox.js') !!}

{{-- SELECT DE OFERTA --}}
<script>
    $(document).on("ready", function(){
        @if($post->oferta == 0)
        $("#oferta_precio").hide();
        @endif

        $("#oferta").on("change", function(){
            $("#oferta_precio").show();
        });

        $("#normal, #destacado").on("change", function(){
            $("#oferta_precio").hide();
        });

    });
</script>

{{-- SELECT 2 --}}
{!! HTML::script('assets/global/plugins/select2/js/select2.full.min.js') !!}
{!! HTML::script('assets/pages/scripts/components-select2.js') !!}

{{-- CALCULAR COSTOS --}}
<script>

    $(document).on("ready", function(){

        $("#calcular_costos").on("click", function(e){

            e.preventDefault();

            var form = $("#formRegister");
            var url = '{{ route('admin.inmuebles.calcular.costo') }}';
            var data = form.serialize();

            $.post(url, data, function(result){
                $("#calculo_precio_costo").text(result.precio_costo);
                $("#calculo_utilidad").text(result.utilidad);
                $("#calculo_gastos_operativos").text(result.gastos_operativos);
                $("#calculo_gastos_envio").text(result.gastos_envio);
                $("#calculo_impuesto").text(result.impuesto);
                $("#calculo_precio_venta").text(result.precio_venta);
                $("#calculo_precio_oferta").text(result.precio_oferta);
            }).fail(function(result){
                console.log(result);
            });
        });

    });

</script>
@stop
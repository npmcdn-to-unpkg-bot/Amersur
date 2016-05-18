@extends('layouts.admin')

{{-- Page title --}}
@section('title')
Ver registro
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
{{ HTML::style('admin/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}
{{ HTML::style('admin/css/pages/form_layouts.css') }}
@stop


{{-- Page content --}}
@section('content_admin')
<section class="content-header">
    <!--section starts-->
    <h1>
        Ver registro
    </h1>
</section>
<!--section ends-->
<section class="content">
    <!--main content-->
    <div class="row">
        <!--row starts-->
        <div class="col-lg-12">

            <!--basic form starts-->
            <div class="panel panel-danger">
                <div class="panel-body border">

                    <div class="form-horizontal form-bordered">

                        <div class="form-group">
                            {{ Form::label('titulo', 'Titulo', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('titulo', $tag->titulo, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('publicar', 'Publicar', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                @if ($tag->publicar == 1)
                                <label class="checkbox-inline">Si</label>
                                @else
                                <label class="checkbox-inline">No</label>
                                @endif
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('administrador.tags.edit', $tag->id) }}" class="btn btn-responsive btn-primary btn-md">Editar</a>
                                <a href="{{ route('administrador.tags.index') }}" class="btn btn-responsive btn-default btn-md">Ver registros</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <!--md-6 ends-->

    </div>
    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
{{ HTML::script('admin/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}
@stop
@extends('layouts.admin')

@section('contenido_admin_title')
    Subir fotos
@stop

@section('contenido_header')
{{-- DROPZONE --}}
{!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/dropzone/3.11.0/css/dropzone.css') !!}
@stop

@section('contenido_admin')

    <div class="row">
        <div class="col-lg-12">

            <div class="portlet box blue-hoki">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>{{ $posts->titulo }}
                    </div>
                </div>

                <div class="portlet-body">

                    <div class="panel panel-info" style="overflow:auto;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Seleccionar archivos</h3>
                        </div>

                        <div class="panel-body" style="padding:0px !important;">
                            <div class="col-md-12" style="padding:30px; float:center;">
                                {!! Form::open(['route' => ['admin.inmuebles.img.store', $posts->id], 'method' => 'POST', 'class' => 'dropzone']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('admin.inmuebles.img.list', $posts->id) }}" class="btn btn-primary">Ver fotos</a>
                    <a href="{{ route('admin.inmuebles.index') }}" class="btn btn-primary">Ir a lista de productos</a>

                </div>

            </div>

        </div>
    </div>

@stop

@section('contenido_footer')
{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/dropzone/3.11.0/dropzone-amd-module.min.js') !!}
@stop
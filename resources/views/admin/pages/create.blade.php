@extends('layouts.admin')

@section('contenido_header')
@stop

@section('contenido_admin_title')
    Preguntas Frecuentes - Nuevo
@stop

@section('contenido_admin')
<!--main content-->
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
                    <i class="fa fa-globe"></i>Preguntas Frecuentes - Nuevo
                </div>
            </div>

            <div class="portlet-body form">
                {!! Form::open(['route' => 'admin.pages.store', 'method' => 'POST', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                    <div class="form-group">
                        {!! Form::label('titulo', 'Titulo', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('titulo', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('contenido', 'Contenido', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('contenido', null, ['class' => 'form-control ckeditor_full']) !!}
                        </div>
                    </div>

                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
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
{{-- CKEDITOR --}}
{!! HTML::script('assets/global/plugins/ckeditor/ckeditor.js') !!}
{!! HTML::script('assets/global/plugins/ckeditor/adapters/jquery.js') !!}
{!! HTML::script('assets/admin/pages/scripts/ckeditor.js') !!}
@stop
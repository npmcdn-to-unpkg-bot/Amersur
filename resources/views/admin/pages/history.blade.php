@extends('layouts.admin')

@section('contenido_header')
{!! HTML::style('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') !!}
@stop

@section('contenido_admin_title')
    Historial de cambios
@stop

@section('contenido_admin')

    <div class="row">
        <div class="col-lg-12">

            <div class="portlet box blue-hoki">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>{{ $post->titulo }}
                    </div>
                </div>

                <div class="portlet-body">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Contenido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $item)
                            <tr>
                                <td>{{ $item->user->profile->nombres." ".$item->user->profile->apellidos }}</td>
                                <td>{{ date_format(new DateTime($item->created_at), 'd/m/Y H:i')  }}</td>
                                <td>{{ trans('others.'.$item->type) }}</td>
                                <td><a class="btn default" data-target="#contenido-{{ $item->id }}" data-toggle="modal">Ver contenido</a></td>
                            </tr>
                            @endforeach
                            <tr>
                                @if($post->usuario_id == "")
                                    <td>Administrador</td>
                                @else
                                    <td>{{ $post->user->profile->nombres." ".$post->user->profile->apellidos }}</td>
                                @endif
                                <td>{{ date_format(new DateTime($post->created_at), 'd/m/Y H:i')  }}</td>
                                <td>{{ trans('others.create') }}</td>
                                <td><a class="btn default" data-target="#contenido" data-toggle="modal">Ver contenido</a></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col-md-7 col-sm-12">
                            <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                {!! $posts->appends(Request::all())->render() !!}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('contenido_footer')

{{-- */
$origin_contenido = json_decode($post->history, true);
/* --}}
<div id="contenido" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Cambio</h4>
    </div>
    <div class="modal-body">
        <p><strong>Titulo:</strong> {{ $origin_contenido['titulo'] }}</p>
        <p><strong>Contenido:</strong></p>
        {!! $origin_contenido['contenido'] !!}
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
    </div>
</div>

@foreach($posts as $item)
{{-- */
$history_id = $item->id;
$history_contenido = json_decode($item->descripcion, true);
/* --}}
<div id="contenido-{{ $history_id }}" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Cambio</h4>
    </div>
    <div class="modal-body">
        <p><strong>Titulo:</strong> {{ $history_contenido['titulo'] }}</p>
        <p><strong>Contenido:</strong></p>
        {!! $history_contenido['contenido'] !!}
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
    </div>
</div>
@endforeach

{{-- MODAL --}}
{!! HTML::script('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') !!}
@stop
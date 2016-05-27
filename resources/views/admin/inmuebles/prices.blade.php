@extends('layouts.admin')

@section('contenido_header')
{!! HTML::style('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') !!}
@stop

@section('contenido_admin_title')
    Historial de Precios
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
                                <th>Moneda</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $item)
                            <tr>
                                <td>{{ $item->user->profile->nombres." ".$item->user->profile->apellidos }}</td>
                                <td>{{ date_format(new DateTime($item->created_at), 'd/m/Y H:i')  }}</td>
                                <td>{{ $item->money->titulo }}</td>
                                <td>{{ $item->precio_unidad }}</td>
                            </tr>
                            @endforeach
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
@stop
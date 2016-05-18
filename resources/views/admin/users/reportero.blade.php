@extends('layouts.admin')

{{-- Page title --}}
@section('title')
Usuarios - Reportero Ciudadano
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
{{ HTML::style('admin/vendors/datatables/css/dataTables.colReorder.min.css') }}
{{ HTML::style('admin/vendors/datatables/css/dataTables.scroller.min.css') }}
{{ HTML::style('admin/vendors/datatables/css/dataTables.bootstrap.css') }}
{{ HTML::style('admin/css/pages/tables.css') }}
{{ HTML::style('admin/vendors/Buttons-master/css/buttons.css') }}

{{-- MODAL --}}
{{ HTML::style('admin/libs/modal/css/basic.css') }}
@stop

{{-- Page content --}}
@section('content_admin')
<section class="content-header">
    <h1>Usuarios - Reportero Ciudadano</h1>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-body">

                {{ Form::model(Input::all(), ['route' => 'administrador.users.reporteroList', 'method' => 'GET', 'class' => 'form-horizontal']) }}

                    <div class="form-group">
                        <div class="col-md-2">
                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                        </div>
                        <div class="col-md-2">
                            {{ Form::select('activacion', ['' => 'Seleccionar estado', '0' => 'No activo', '1' => 'Activo'], null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-1">
                            {{ Form::button('Buscar', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('administrador.users.reporteroList') }}" class="btn btn-danger">Borrar busqueda</a>
                        </div>
                    </div>

                {{ Form::close() }}

                <table class="table table-striped table-responsive">
                    <thead>
                        <tr class="filters">
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Fecha registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        {{--*/
                        $usuario = $user->profile->nombre." ".$user->profile->apellidos;
                        /*--}}
                        <tr data-id="{{ $user->id }}"  data-title="{{ $usuario }}">
                    		<td>{{ $user->profile->nombre }}</td>
            				<td>{{ $user->profile->apellidos }}</td>
            				<td>{{ $user->email }}</td>
                            <td>{{ date_format(new DateTime($user->created_at), 'd/m/Y H:i')  }}</td>
                            <td>{{ $user->activacion ? 'Activado' : 'No activado' }}</td>
            				<td><a class="btn-view" href="#">Ver datos</a></td>
            			</tr>
                    @endforeach
                        
                    </tbody>
                </table>

                <div class="row">

                    <div class="col-md-5 col-sm-12">
                        <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">Total de registros: {{ $users->getTotal() }}</div>
                    </div>

                    <div class="col-md-7 col-sm-12">
                        <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
                            {{ $users->links() }}
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>    <!-- row-->
</section>

{{-- MODAL --}}
<div id="basic-modal-content">
    <div class="imagen">
        <img src="" alt="" width="200" height="200">
    </div>
    <div class="datos">
        <div class="modal-section modal-usuario">
            <span class="modal-label">Nombre: </span>
            <span class="dato"></span>
        </div>
        <div class="modal-section modal-email">
            <span class="modal-label">Email: </span>
            <span class="dato"></span>
        </div>
        <div class="modal-section modal-estado">
            <span class="modal-label">Estado: </span>
            <span class="dato"></span>
        </div>
        <div class="modal-section modal-fecharegistro">
            <span class="modal-label">Fecha Registro: </span>
            <span class="dato"></span>
        </div>
        <div class="modal-section">
            <h3>Noticias</h3>
        </div>
        <div class="modal-section modal-notenviadas">
            <span class="modal-label">Enviadas: </span>
            <span class="dato"></span>
        </div>
        <div class="modal-section modal-notpublicas">
            <span class="modal-label">Publicadas: </span>
            <span class="dato"></span>
        </div>
    </div>    
</div>

{{ Form::open(['route' => ['administrador.users.reporteroView', ':REGISTER'], 'method' => 'POST', 'id' => 'FormViewRow']) }}
{{ Form::close() }}

@stop

{{-- page level scripts --}}
@section('footer_scripts')
{{-- MODAL --}}
{{ HTML::script('admin/libs/modal/js/jquery.simplemodal.js') }}

{{-- VER DATOS DE USUARIO --}}
<script>
$(document).on("ready", function(){
    $(".btn-view").on("click", function(){
        var row = $(this).parents("tr");
        var id = row.data("id");
        var title = row.data("title");
        var form = $("#FormViewRow");
        var url = form.attr("action").replace(':REGISTER', id);
        var data = form.serialize();
        
        $(".modal-title").text(title);

        $.post(url, data, function(result){
            $('.imagen img').attr('src', result.imagen);
            $('.modal-usuario .dato').text(result.nombre);
            $('.modal-email .dato').text(result.email);
            $('.modal-estado .dato').text(result.estado);
            $('.modal-fecharegistro .dato').text(result.fregistro);
            $('.modal-notenviadas .dato').text(result.notenviadas);
            $('.modal-notpublicas .dato').text(result.notpublicas);

            $('#basic-modal-content').modal();
        }).fail(function(){
            $(".alert").show().removeClass('alert-success').addClass('alert-danger').text("Se produjo un error al eliminar el registro");
            row.show();
        });
    });
});

</script>

@stop
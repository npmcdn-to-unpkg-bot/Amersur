<div class="modal-header">
    <h4 class="modal-title">Servicio</h4>
</div>
<div class="modal-body servicio-contenido">

    <div class="col-md-12">
        <h2>{{ $row->titulo }}</h2>
        {!! $row->contenido !!}
    </div>

    <div class="row"></div>

</div>
<div class="modal-footer servicio-footer">
    <a class="btn default" data-dismiss="modal" id="formCreateClose">Cerrar</a>
</div>
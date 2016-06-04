@extends('layouts.frontend')

@section('contenido_header')
@stop

@section('contenido_body')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main about-main">
    <div class="about">
        <h3>Nosotros</h3>
        <div class="col-md-10 about-grids">
            {!! $nosotros->contenido !!}
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@stop

@section('contenido_footer')
@stop
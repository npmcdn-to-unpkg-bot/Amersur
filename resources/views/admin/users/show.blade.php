@extends('layouts.admin')

{{-- Page title --}}
@section('title')
Ver usuario
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
{{ HTML::style('admin/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}
{{ HTML::style('admin/css/pages/form_layouts.css') }}
<!--end of page level css-->
@stop

{{-- Page content --}}
@section('content_admin')
<section class="content-header">
    <h1>Ver usuario</h1>
</section>

<section class="content">

    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-danger">

                <div class="panel-body border">

                    <div class="form-horizontal form-bordered">

                        <div class="form-group">
                            {{ Form::label('first_name', 'Nombre', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('first_name', $user->first_name, ['class' => 'form-control required', 'disabled']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('last_name', 'Apellidos', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('last_name', $user->last_name, ['class' => 'form-control required', 'disabled']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::email('email', $user->email, ['class' => 'form-control required', 'disabled']) }}
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('administrador.users.edit', $user->id) }}" class="btn btn-responsive btn-primary btn-md">Editar</a>
                                <a href="{{ route('administrador.users.index') }}" class="btn btn-responsive btn-default btn-md">Ver registros</a>
                            </div>
                        </div>

                    </div>
                    <!-- END FORM WIZARD WITH VALIDATION -->

                </div>
            </div>
        </div>
    </div>
    <!--row end-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
{{ HTML::script('admin/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}
{{ HTML::script('admin/vendors/wizard/jquery-steps/js/wizard.js') }}
{{ HTML::script('admin/vendors/wizard/jquery-steps/js/jquery.steps.js') }}
{{ HTML::script('admin/vendors/wizard/jquery-steps/js/form_wizard.js') }}
@stop
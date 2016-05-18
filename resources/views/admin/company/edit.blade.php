@extends('layouts.admin')

@section('contenido_admin_title')
    Empresa
@stop

@section('contenido_admin')
<div class="row">
	<!--row starts-->
	<div class="col-lg-12">

        @include('flash::message')

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
                    <i class="fa fa-globe"></i>Empresa
                </div>
            </div>

			<div class="portlet-body form">
				{!! Form::model($company, ['route' => 'admin.company.us.update', 'method' => 'PUT', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                    <div class="form-group">
                        <div class="col-md-12">
                            <h2>Nosotros</h2>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::textarea('contenido_nosotros', null, ['class' => 'form-control ckeditor_full']) !!}
                        </div>
                    </div>
                    
                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar cambios', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
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
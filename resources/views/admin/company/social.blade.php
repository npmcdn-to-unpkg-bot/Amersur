@extends('layouts.admin')

@section('contenido_admin_title')
    Redes Sociales
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
                    <i class="fa fa-globe"></i>Redes Sociales
                </div>
            </div>

			<div class="portlet-body form">
				{!! Form::model($social, ['route' => 'admin.company.social.update', 'method' => 'PUT', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                    <div class="form-group">
                        {!! Form::label('facebook', 'Facebook', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('facebook', null, ['class' => 'form-control', 'placeholder' => 'https://facebook.com']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('instagram', 'Instagram', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('instagram', null, ['class' => 'form-control', 'placeholder' => 'https://www.instagram.com/']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('google', 'Google+', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('google', null, ['class' => 'form-control', 'placeholder' => 'https://plus.google.com/']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('pinterest', 'Pinterest', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('pinterest', null, ['class' => 'form-control', 'placeholder' => 'https://www.pinterest.com/']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('tumblr', 'Tumblr', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('tumblr', null, ['class' => 'form-control', 'placeholder' => 'https://www.tumblr.com/']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('twitter', 'Twitter', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('twitter', null, ['class' => 'form-control', 'placeholder' => 'https://twitter.com/']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('youtube', 'YouTube', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('youtube', null, ['class' => 'form-control', 'placeholder' => 'https://www.youtube.com/']) !!}
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
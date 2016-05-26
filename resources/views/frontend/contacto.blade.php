@extends('layouts.frontend')

@section('contenido_header')
@stop

@section('contenido_body')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main about-main">
        <div class="contact">
            <h3>How To Find Us</h3>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.182370726!2d-0.10159865000000001!3d51.52864165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C+UK!5e0!3m2!1sen!2sin!4v1433744055746" frameborder="0" style="border:0"></iframe>
            </div>
            <div class="contact-grids">
                <div class="col-md-4 address">
                    <h3>Contact Info</h3>
                    <p class="cnt-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit,sheets containing Lorem Ipsum passages sed do </p>
                    <p>Eiusmod Tempor inc</p>
                    <p>9560 St Dolor,London</p>
                    <p>Telephone : +2 800 544 6035</p>
                    <p>FAX : +1 800 889 4444</p>
                    <p>Email : <a href="mailto:example@mail.com">mail@example.com</a></p>
                </div>
                <div class="col-md-8 contact-form">
                    <h3>Contacto</h3>

                    <div id="mensaje-enviado" style="display: none;">

                        <div class="block-header" style="padding-top: 0;">
                            <h3 class="title">Tu mensaje ha sido enviado.</h3>
                            <div class="description">En breve nos estaremos comunicando contigo.</div>
                        </div>

                    </div>

                    {!! Form::open(['route' => 'frontend.contacto.post', 'method' => 'POST', 'id' => 'contactForm']) !!}

                        {!! Form::text('nombre', null, ['placeholder' => 'Nombre', 'required']) !!}

                        {!! Form::email('email', null, ['placeholder' => 'Email', 'required']) !!}

                        {!! Form::text('telefono', null, ['placeholder' => 'Teléfono', 'required']) !!}

                        {!! Form::textarea('mensaje', null, ['placeholder' => 'Mensaje', 'required']) !!}

                        <div class="g-recaptcha home" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>

                        <a class="button style-10" href="#" id="formContactoSubmit">Enviar mensaje</a>

                        <div class="progressForm col-xs-6">
                            <i class="fa fa-2x fa-circle-o-notch fa-spin"></i>
                        </div>

                    {!! Form::close() !!}

                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@stop

@section('contenido_footer')
{{-- RECAPTCHA --}}
{!! HTML::script('https://www.google.com/recaptcha/api.js') !!}

{{-- CONTACTO --}}
<script>

    $(document).on("ready", function(){

        $('.progressForm .fa').hide();

        $("#formContactoSubmit").on("click", function(e){

            e.preventDefault();

            var form = $("#contactForm");
            var url = form.attr('action');
            var data = form.serialize();

            $('.progressForm .fa').show();

            $.post(url, data, function(result){
                $('.progressForm .fa').hide();
                $(".contact-content").addClass('alert').addClass('alert-success').text(result.message);
                form.slideUp();
                $('#mensaje-enviado').slideDown();
                form[0].reset();
            }).fail(function(result){
                $('.progressForm .fa').hide();
                console.log(result);
                $(".contact-content").text("Se produjo un error al enviar el mensaje. Intentelo de nuevo más tarde.");

                if(result.status === 422){

                    var errors = result.responseJSON;

                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    errorsHtml += '</ul></di>';

                    $('.contact-content').html(errorsHtml);

                };

            });

        });

    });

</script>

@stop
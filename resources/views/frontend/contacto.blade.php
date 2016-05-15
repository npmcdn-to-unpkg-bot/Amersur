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
                    <h3>Contact Form</h3>
                    <form>
                        <input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
                        <input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                        <input type="text" value="Telephone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Telephone';}" required="">
                        <textarea type="text"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
                        <input type="submit" value="Submit" >
                    </form>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@stop

@section('contenido_footer')
@stop
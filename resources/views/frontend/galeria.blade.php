@extends('layouts.frontend')

@section('contenido_header')
{!! HTML::style('css/jquery.fancybox.css') !!}
@stop

@section('contenido_body')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main about-main">

    <div class="gallery">
        <h3>Gallery</h3>
        <div class="gallery-info">
            <div class="col-md-4 galry-grids">
                <a class="b-link-stripe b-animate-go fancybox" href="images/img22.jpg" data-fancybox-group="gallery" >
                    <img src="images/img22.jpg" class="img-responsive img-style row6" alt="">
                    <div class="b-wrapper">
                        <span class="b-animate b-from-left    b-delay03 ">
                            <img class="img-responsive zoom-img img-circle" src="images/e.png" alt=""/>
                        </span>
                    </div>
                </a>
                <a class="b-link-stripe b-animate-go fancybox" href="images/img23a.jpg" data-fancybox-group="gallery" >
                    <img src="images/img23.jpg" class="img-responsive img-style row6" alt="">
                    <div class="b-wrapper">
                        <span class="b-animate b-from-left    b-delay03 ">
                            <img class="img-responsive zoom-img img-circle" src="images/e.png" alt=""/>
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 galry-grids">
                <a class="b-link-stripe b-animate-go fancybox" href="images/img5a.jpg" data-fancybox-group="gallery" >
                    <img src="images/img5.jpg" class="img-responsive img-style row6" alt="">
                    <div class="b-wrapper">
                        <span class="b-animate b-from-left    b-delay03 ">
                            <img class="img-responsive zoom-img img-circle" src="images/e.png" alt=""/>
                        </span>
                    </div>
                </a>
                <a class="b-link-stripe b-animate-go fancybox" href="images/img12a.jpg" data-fancybox-group="gallery" >
                    <img src="images/img12.jpg" class="img-responsive img-style row6" alt="">
                    <div class="b-wrapper">
                        <span class="b-animate b-from-left    b-delay03 ">
                            <img class="img-responsive zoom-img img-circle" src="images/e.png" alt=""/>
                        </span>
                    </div>
                </a>
                <a class="b-link-stripe b-animate-go fancybox" href="images/img3a.jpg" data-fancybox-group="gallery" >
                    <img src="images/img3.jpg" class="img-responsive img-style row6" alt="">
                    <div class="b-wrapper">
                        <span class="b-animate b-from-left    b-delay03 ">
                            <img class="img-responsive zoom-img img-circle" src="images/e.png" alt=""/>
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 galry-grids">
                <a class="b-link-stripe b-animate-go fancybox glry-img1" href="images/img13a.jpg" data-fancybox-group="gallery" >
                    <img src="images/img13.jpg" class="img-responsive img-style row6" alt="">
                    <div class="b-wrapper">
                        <span class="b-animate b-from-left    b-delay03 ">
                            <img class="img-responsive zoom-img img-circle" src="images/e.png" alt=""/>
                        </span>
                    </div>
                </a>
                <a class="b-link-stripe b-animate-go fancybox glry-img2" href="images/img4a.jpg" data-fancybox-group="gallery" >
                    <img src="images/img4.jpg" class="img-style row6" alt="">
                    <div class="b-wrapper">
                        <span class="b-animate b-from-left    b-delay03 ">
                            <img class="img-responsive zoom-img img-circle" src="images/e.png" alt=""/>
                        </span>
                    </div>
                </a>
                <a class="b-link-stripe b-animate-go fancybox glry-img3" href="images/img24a.jpg" data-fancybox-group="gallery" >
                    <img src="images/img24.jpg" class="img-responsive img-style row6" alt="">
                    <div class="b-wrapper">
                        <span class="b-animate b-from-left    b-delay03 ">
                            <img class="img-responsive zoom-img img-circle" src="images/e.png" alt=""/>
                        </span>
                    </div>
                </a>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

</div>
@stop

@section('contenido_footer')
{!! HTML::script('js/jquery.fancybox.js') !!}
<script>
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
</script>
@stop
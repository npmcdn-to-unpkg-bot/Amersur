@extends('layouts.frontend')

@section('contenido_header')
@stop

@section('contenido_body')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main about-main">
    <div class="about">
        <h3>About Us</h3>
        <div class="col-md-4 about-grids">
            <img src="images/img7.jpg" alt=""/>
        </div>
        <div class="col-md-4 about-grids">
            <h4>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots</h4>
            <p>Lorem Ipsum was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
                including versions.It is a long established fact that a reader will be simply random text. It has roo distracted</p>
        </div>
        <div class="col-md-4 about-grids">
            <ul>
                <li><a href="#">Pestablished fact</a></li>
                <li><a href="#">Apopular belief</a></li>
                <li><a href="#">Vsimply random text</a></li>
                <li><a href="#">Letraset sheetsel </a></li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="about-slid">
        <div class="abt-slid-text">
            <h2>What we do</h2>
            <p>The standard Lorem Ipsum passage, used sincepassage</p>
        </div>
    </div>
    <div class="team">
        <h3>Our Team Members</h3>
        <div class="team-info">
            <div class="col-md-3 about-team-grids">
                <img src="images/img8.jpg" alt=""/>
                <div class="team-text">
                    <h5>JOHN DOE</h5>
                    <h6>Founder</h6>
                </div>
            </div>
            <div class="col-md-3 about-team-grids">
                <img src="images/img9.jpg" alt=""/>
                <div class="team-text">
                    <h5>JERRY JON</h5>
                    <h6>Co-founder</h6>
                </div>
            </div>
            <div class="col-md-3 about-team-grids">
                <img src="images/img10.jpg" alt=""/>
                <div class="team-text">
                    <h5>JAME MONY</h5>
                    <h6>Designer</h6>
                </div>
            </div>
            <div class="col-md-3 about-team-grids">
                <img src="images/img11.jpg" alt=""/>
                <div class="team-text">
                    <h5>JOHN SMITH</h5>
                    <h6>Developer</h6>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
@stop

@section('contenido_footer')
@stop
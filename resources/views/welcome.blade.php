@extends('template')

@section('title', 'JCube Basketball | Home')

@section('content')
   <div class="carousel">
        <div id="demo" class="carousel slide" data-ride="carousel">
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
            <li data-target="#demo" data-slide-to="3"></li>
            <li data-target="#demo" data-slide-to="4"></li>
            <li data-target="#demo" data-slide-to="5"></li>
            <li data-target="#demo" data-slide-to="6"></li>
          </ul>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/1.jpg" alt="1.jpg" class="carousel-image">
              <div class="carousel-caption caption-box">
                <h3>Jcube Basketball</h3>
                <p>Joseph Bautista playing the point.</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="images/2.jpg" alt="2.jpg" class="carousel-image">
              <div class="carousel-caption caption-box">
                <h3>Jcube Basketball</h3>
                <p>D'Rocks Basketball Team</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="images/3.jpg" alt="3.jpg" class="carousel-image">
              <div class="carousel-caption caption-box">
                <h3>Jcube Basketball</h3>
                <p>This is what Camaraderie Cup is made for.</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="images/4.jpg" alt="4.jpg" class="carousel-image">
              <div class="carousel-caption caption-box">
                <h3>Jcube Basketball</h3>
                <p>Splitting the defense.</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="images/5.jpg" alt="5.jpg" class="carousel-image">
              <div class="carousel-caption caption-box">
                <h3>Jcube Basketball</h3>
                <p>ATTACK!</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="images/6.jpg" alt="6.jpg" class="carousel-image">
              <div class="carousel-caption caption-box">
                <h3>Jcube Basketball</h3>
                <p>Where humans became anime characters</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="images/7.jpg" alt="7.jpg" class="carousel-image">
              <div class="carousel-caption caption-box ">
                <h3>Jcube Basketball</h3>
                <p>The Bae.</p>
              </div>   
            </div>
          </div>
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>

    </div>

@endsection
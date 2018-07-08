<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
session_start();
if (!isset($_SESSION["cart"]))
  $_SESSION["cart"]=array();
if (isset($_POST["btn"]))
{
  array_push($_SESSION["cart"], $_POST["btn"]);
}
if (false)
  session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Wall</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url('nowbg.jpg')">



    <nav style="background-color: #029DAB" class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="#">WebSiteName</a> -->
          <a class="navbar-logo" style="margin:10px; margin-right: 50px;" href="#">
            <!-- div -->
            <img src="img/logo.png" style="max-height: 50px !important; width: auto; margin-right: 2%; margin-bottom: 1%;">
            <span style="color: #fff; ">
                Hookah Pani
            </span>
          </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-left">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="wall.html">The Wall</a>
            </li>
            <li><a href="jango.html">Jango</a>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="c1.html">Concordia 1<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="c1-stationary.html">Stationary Shop</a></li>
                <li><a href="c1-mart.html">Mart</a></li>
                <li><a href="c1-cafe.html">Cafetaria</a></li>
              </ul>
            </li>
            <!-- <a  href="#cafe">Main Cafe</a> -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="c2.html">Boys' Cafe<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="c1-stationary.html">Stationary Shop</a></li>
                <li><a href="c1-mart.html">Mart</a></li>
                <li><a href="c1-cafe.html">Cafetaria</a></li>
              </ul>
            </li>
            <li><a href="about.html">About</a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" href="signup.html"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
      </div>
    </nav><!-- jango -->

<div class="container">
  <div class="demo-1">
    <div class="main">
  <h1><center>The Wall</center></h1>
    </div>
  </div>
</div>
<br/>
<br/>
<div class="container">
  <div class="row">
    
    <div class="col-md-4 items">
    <img src="img/food/beef.jpg" alt="309" style="width:100%; height: 100%;" class="img-responsive gallery image1">
      <div class="mid">
        <form action="" method="POST">
          <button class="btn" value="1" name="btn"><i>Beef burger with fries in just <br/>Rs. 150<br/><b>Order Now</b></i></button>
        </form>
      </div>
    </div>
    
    <div class="col-md-4 items">
    <img src="img/food/anda.jpg" alt="c2" style="width:100%; height: 100%;" class="img-responsive gallery image1">
      <div class="mid">
          <a href="#"><div class="text-1" style="text-align: center;">Anda Shami burger with fries in just <br/>Rs. 70<br/><b>Order Now</b></div></a>
        </div>
    </div>

    <div class="col-md-4 items">
    <img src="img/food/chicken.jpg" alt="c2" style="width:100%; height: 100%;" class="img-responsive gallery image1">
      <div class="mid">
          <a href="#"><div class="text-1" style="text-align: center;">Chicken Piece in just<br/>Rs. 140<br/><b>Order Now</b></div></a>
        </div>
    </div>
  </div>


  <div class="row">
    
    <div class="col-md-4 items">
    <img src="img/food/shawarma.jpg" alt="309" style="width:100%; height: 100%;" class="img-responsive gallery image1">
      <div class="mid">
          <a href="#"><div class="text-1" style="text-align: center;">Chicken Shawarma with fries in just <br/>Rs. 110<br/><b>Order Now</b></div></a>
        </div>
    </div>
    
    <div class="col-md-4 items">
    <img src="img/food/sandwich.jpg" alt="c2" style="width:100%; height: 100%;" class="img-responsive gallery image1">
      <div class="mid">
          <a href="#"><div class="text-1" style="text-align: center;">Chicken Sandwich with fries in just <br/>Rs. 100<br/><b>Order Now</b></div></a>
        </div>
    </div>

    <div class="col-md-4 items">
    <img src="img/food/paratha.jpg" alt="c2" style="width:100%; height: 100%;" class="img-responsive gallery image1">
      <div class="mid">
          <a href="#"><div class="text-1" style="text-align: center;">Chicken Paratha Roll in just <br/>Rs. 90<br/><b>Order Now</b></div></a>
        </div>
    </div>
  </div>


  <div class="row">
    
    <div class="col-md-4 items">
    <img src="img/food/pizza.jpg" alt="309" style="width:100%; height: 100%;" class="img-responsive gallery image1">
      <div class="mid">
          <a href="#"><div class="text-1" style="text-align: center;">Chicken Tikka Pizza large<br/>Rs. 900<br/><b>Order Now</b></div></a>
        </div>
    </div>
    
    <div class="col-md-4 items">
    <img src="img/food/chai.jpg" alt="c2" style="width:100%; height: 100%;" class="img-responsive gallery image1">
      <div class="mid">
          <a href="#"><div class="text-1" style="text-align: center;">Regular Tea in just<br/>Rs. 20<br/><b>Order Now</b></div></a>
        </div>
    </div>

    <div class="col-md-4 items">
    <img src="img/food/coffee.jpg" alt="c2" style="width:100%; height: 100%;" class="img-responsive gallery image1">
      <div class="mid">
          <a href="#"><div class="text-1" style="text-align: center;">Coffee in just <br/>Rs. 60<br/><b>Order Now</b></div></a>
        </div>
    </div>
  </div>
</div>

<!-- Google map api -->

<div class="container">
 <div id="map">
    <script>
      function initMap() {
        var uluru = {lat: 33.64780553, lng: 72.99087346};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn57IZ7kE9rMX84tSUegac6WYYLO2CWcw&callback=initMap">
    </script>
</div>
</div>
<!-- footer -->

<footer>
<div class="container">
<div class="row">
  <div class="col-md-6 col-xs-12">
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact Us</a></li>
    <li><a href="#">Privacy Policy</a></li>
  </ul>
  </div>
  <div class="col-md-6 col-xs-12">
<p style="float: ">Copyrights &copy; 2017, All Rights Reserved</p>
  </div>
</div>

</div>

</footer>
</body>
</html>
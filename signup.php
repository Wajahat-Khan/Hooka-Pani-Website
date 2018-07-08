<?php 
include 'connect.php';
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/jquery.fancybox.css" rel="stylesheet">
  <link href="css/flexslider.css" rel="stylesheet" />
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
    </nav>
<div class="container">
	<div class="demo-1">
		<div class="main">
	<h2><center>Registration</center></h2>
		</div>
	</div>
</div>
<br/>
<br/>

<!-- S
<!-- Sign up Form -->

<div class="container">
  <center><form class="form-horizontal" action="" method="post"  id="reg_form">
    <fieldset>    
      <div class="form-group">
        <label class="col-md-5 control-label">First Name</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="first_name" pattern="[A-Za-z]{3,}"   placeholder="First Name" class="form-control"  type="text">
          </div>
        </div>
      </div>


     <div class="form-group">
        <label class="col-md-5 control-label" >Last Name</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="last_name" pattern="[A-Za-z]{3,}"   placeholder="Last Name" class="form-control"  type="text">
          </div>
        </div>
      </div>
           
      <div class="form-group">
        <label class="col-md-5 control-label">E-Mail</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input name="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="E-Mail Address" class="form-control"  type="text">
          </div>
        </div>
      </div>

          <div class="form-group">
        <label class="col-md-5 control-label">Password</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  type ="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"   placeholder="Password" class="form-control"  type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-5 control-label">Phone #</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input name="phone" pattern="[0-9]{4}-[0-9]{7}"    placeholder="0301-6063167" class="form-control" type="text">
          </div>
        </div>
      </div>
            
      <div class="form-group">
        <label class="col-md-5 control-label">Address</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
            <input name="address"   placeholder="Address" class="form-control" type="text">
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-5 control-label">NUST ID</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input name="id" pattern="[0]{5}[0-9]{6}"    placeholder="00000119988" class="form-control" type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-5 control-label">Picture </label>
        <div class="col-md-6  inputGroupContainer" >
          <div class="form-group">
            <input style="float: left; margin-left: 3%;" type="file" name="file" id="file"  >
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-5 control-label"></label>
        <div class="col-md-4">
          <button type="submit" name="reg" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
        </div>
      </div>
     </fieldset>
  </form></center>
</div>



<!-- /.container --> 


<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>  
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<!-- Vendor Scripts -->
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>

</body>
</html>

<?php 
if (isset($_POST["reg"]))
{
$id=$_POST["id"];
$fn=$_POST["first_name"];
$ln=$_POST["last_name"];
$em=$_POST["email"];
$pass=$_POST["password"];
$phone=$_POST["phone"];
$add=$_POST["address"];

$query="insert into users values ('$id', '$fn', '$ln', '$em', '$pass','$phone','$add',0)";
$result=$conn->query($query);
$_SESSION["id"]=$_POST["id"];
echo "<script type=text/javascript>  alert('You are Successfully Registered'); </script>";

}
?>
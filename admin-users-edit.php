<?php 
require 'connect.php';
?>

<?php  
if(!isset($_SESSION["admin_id"])){
    header('Location:admin.php');
}
?>

<?php

if(isset($_POST["users_add"])){
$id=$_POST["users_id_edit"];
$fname=$_POST["users_fname_edit"];
$lname=$_POST["users_lname_edit"];
$email=$_POST["users_email_edit"];
$pass=$_POST["users_pass_edit"];
$phone=$_POST["users_phone_edit"];
$address=$_POST["users_add_edit"]; 
$query="insert into users values ('$id', '$fname', '$lname','$email','$pass','$phone','$address')";
$result=$conn->query($query);

header('Location:admin-users.php');
exit();
}

else if (isset($_POST["users_change"])){
$id=$_POST["users_id_edit"];
$fname=$_POST["users_fname_edit"];
$lname=$_POST["users_lname_edit"];
$email=$_POST["users_email_edit"];
$pass=$_POST["users_pass_edit"];
$phone=$_POST["users_phone_edit"];
$address=$_POST["users_add_edit"]; 

$query= "update users SET ID ='$id', FName='$fname', LName='$lname', Email='$email',password='$pass',Phone='$phone',Address='$address' where ID=$id";
$conn->query($query);
 
header('Location:admin-users.php');
exit();
}

else if(isset($_POST["users_delete"])){
$id=$_POST["users_id_edit"];
 $query="delete from orders where Nust_id=$id";  
 $conn->query($query);
 $query="delete from users where ID=$id";  
 $result=$conn->query($query);
header('Location:admin-users.php');  
exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=200678680495680";
                fjs.parentNode.insertBefore(js, fjs);
            }
            (document, 'script', 'facebook-jssdk'));
    </script>
</head>

<body style="background-image: url('adminbkg.jpg')">



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
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="wall.php">The Wall</a>
            </li>
            <li><a href="jango.php">Jango</a>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="c1.php">Concordia 1<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="c1-stationary.php">Stationary Shop</a></li>
                <li><a href="c1-mart.php">Mart</a></li>
                <li><a href="c1-cafe.php">Cafetaria</a></li>
              </ul>
            </li>
            <!-- <a  href="#cafe">Main Cafe</a> -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="c2.php">Boys' Cafe<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="c1-stationary.php">Stationary Shop</a></li>
                <li><a href="c1-mart.php">Mart</a></li>
                <li><a href="c1-cafe.php">Cafetaria</a></li>
              </ul>
            </li>
            <li><a href="about.php">About</a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a data-toggle="modal" data-target="#myModal" id="log"><span class="glyphicon glyphicon-log-in" ></span> Login</a></li>
          </ul> 
        </div>
      </div>
    </nav>

<div class="container">
  <div class="demo-1">
  <h1 style="color:white; font-size: 60px; margin-top: 5%; margin-left: 10%;"><center>Edit Users</center></h1>
  </div>
</div>

<div class="container" style="margin-top: 10%; margin-bottom:10%">
  <center><form class="form-horizontal" action="" method="post"  id="admin_form">
    <fieldset> 

      <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">User ID</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input  name="users_id_edit" placeholder="ID" class="form-control"  type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">First Name</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input  name="users_fname_edit" placeholder="First Name" class="form-control"  type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">Last Name</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input  name="users_lname_edit" placeholder="Last Name" class="form-control"  type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">Email</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input  name="users_email_edit" placeholder="Email" class="form-control"  type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">Password</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input  name="users_pass_edit" placeholder="password" class="form-control"  type="password">
          </div>
        </div>
      </div>

          <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">Phone</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input name="users_phone_edit" placeholder="Phone" class="form-control"  type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">Address</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input  name="users_add_edit" placeholder="address" class="form-control"  type="text">
          </div>
        </div>
      </div>

            <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-5">
          <button type="submit" name= "users_change" class="btn btn-primary">Change</button>
          <button type="submit" name= "users_delete" class="btn btn-primary">Delete</button>
          <button type="submit" name= "users_add" class="btn btn-primary">Add</button>
        </div>
      </div>

    </fieldset>
  </form>
</center>
</div>
    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <ul class="clearfix">
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="#">About</a>
                        </li>
                        <li><a href="#">Contact Us</a>
                        </li>
                        <li><a href="#">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; 2017, All Rights Reserved</p>
                </div>
            </div>

        </div>

    </footer>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign In</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" action="" method="post"  id="sign_in">
    <fieldset>   

      <div class="form-group">
        <label class="col-md-5 control-label">NUST ID</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
            <input name="login-id" pattern="[0-9]{6}"    value="119988" class="form-control" type="text">
          </div>
        </div>
      </div>
      
     <div class="form-group">
        <label class="col-md-5 control-label">Password</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="login-password" type="password" required value="waji"  class="form-control"  type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-5 control-label"></label>
        <div class="col-md-4">
          <button type="submit" name= "login" class="btn btn-warning">Send <span class="glyphicon glyphicon-send"></span></button>
        </div>
      </div>
      <div align="center" class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" style="margin-left: 45%;"></div>
    </fieldset>
    </form>


        </div>
      </div>
      
    </div>
  </div>


</body>
</html>
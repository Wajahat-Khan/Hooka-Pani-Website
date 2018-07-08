<?php 
require 'connect.php';
?>

<?php  
if(!isset($_SESSION["admin_id"])){
    header('Location:admin.php');
}
?>

<?php

if(isset($_POST["inv_add"])){
$id=$_POST["inv_id_edit"];
$name=$_POST["inv_name_edit"];
$price=$_POST["inv_price_edit"];
$cafe=$_POST["inv_cafe_id_edit"]; 
$query="insert into inventory values ('$id', '$name', '$price','$cafe')";
$result=$conn->query($query);

header('Location:admin-inv.php');
exit();
}
else if (isset($_POST["inv_change"])){
$id=$_POST["inv_id_edit"];
$name=$_POST["inv_name_edit"];
$price=$_POST["inv_price_edit"];
$cafe=$_POST["inv_cafe_id_edit"]; 

$query= "update Inventory SET Product_ID ='$id', Name='$name', Price='$price', Cafe='$cafe' where Product_ID=$id";
$conn->query($query);
 
header('Location:admin-inv.php');
exit();
}

else if(isset($_POST["inv_delete"])){
 $id=$_POST["inv_id_edit"];
 $query="delete from orders where Product_id=$id";  
 $conn->query($query);
 $query="delete from Inventory where Product_ID=$id";  
 $result=$conn->query($query);
header('Location:admin-inv.php');  
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
  <h1 style="color:white; font-size: 60px; margin-top: 5%; margin-left: 10%;"><center>Edit Inventory</center></h1>
  </div>
</div>

<div class="container" style="margin-top: 10%; margin-bottom:10%">
  <center><form class="form-horizontal" action="" method="post"  id="admin_form">
    <fieldset>    
      <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">Product ID</label>
        <div class="col-md-7  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input  name="inv_id_edit" placeholder="ID" class="form-control"  type="text">
          </div>
        </div>
      </div>


     <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">Name</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input name="inv_name_edit" placeholder="Name" class="form-control"  type="text">
          </div>
        </div>
      </div>

    <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">Price</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input name="inv_price_edit" placeholder="price" class="form-control"  type="text">
          </div>
        </div>
      </div>

          <div class="form-group">
        <label class="col-md-5 control-label" style="color:white">Cafe ID</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"></span>
            <input name="inv_cafe_id_edit" placeholder="Cafe ID" class="form-control"  type="text">
          </div>
        </div>
      </div>

            <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-5">
          <button type="submit" name= "inv_change" class="btn btn-primary">Change</button>
          <button type="submit" name= "inv_delete" class="btn btn-primary">Delete</button>
          <button type="submit" name= "inv_add" class="btn btn-primary">Add</button>
        </div>
      </div>

    </fieldset>
  </form>
</center>
</div>
   
</body>
</html>
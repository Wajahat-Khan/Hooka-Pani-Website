<?php 
require 'connect.php';
?>
<?php 
if (isset($_POST["admin_sign_out"])){
session_destroy();
header('Location:admin.php');
}
?>
<?php  
if(!isset($_SESSION["admin_id"])){
    header('Location:admin.php');
}
?>
<?php  
if(isset($_POST["cafe_edit_direct"])){
  header('Location:admin-cafe-edit.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page-Cafe</title>
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


<style type="text/css">
  .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    margin-top: 50px;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

</head>

<body style="background-image: url('adminbkg.jpg'); overflow-x: hidden !important">



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
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["admin_name"] ?></a></li>
          </ul> 
        </div>
      </div>
    </nav>

<div class="container">
  <div class="demo-1">
  <h1 style="color:white; font-size: 60px; margin-top: 5%; margin-left: 10%;"><center>Admin Panel</center></h1>
  </div>
</div>


<div class="row">
<!-- side bar start-->
<div class="col-md-5">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="admin-cafe.php">Cafe</a>
  <a href="admin-users.php">Users</a>
  <a href="admin-inv.php">Inventory</a>
  <a href="admin-orders.php">Orders</a>
</div>

<span style="font-size:30px;color:white;cursor:pointer" onclick="openNav()">Operations  &#9776;</span>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
</div>
<div class="col-md-5">
  
<?php  
$query="select * from cafe";
$result=$conn->query($query);
echo "<h2 style='margin-left:15%;margin-bottom:10%; color:white'>Cafe Details</h2>";
echo "<table border='5px solid white' style='color:white;margin-left:0px; padding-left:0px;'>
<tr>
<th style='padding:20px;'>Cafe ID</th>
<th style='padding:20px;'>Cafe Name</th>
<th style='padding:20px;'>Phone</th>
</tr>";
while($row=mysqli_fetch_assoc($result))
  {
  echo "<tr>";
  echo "<td style='padding:20px;'>" . $row['Cafe_id'] . "</td>";
  echo "<td style='padding:20px;'>" . $row['Name'] . "</td>";
  echo "<td style='padding:20px;'>" . $row['Phone'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

?>
<center>
<form class="form-horizontal" action="" method="post"  id="admin_sign_out_form">
    <fieldset>    
            <div class="form-group">
             <a href="admin-cafe-edit.php"><button style="margin-top: 5%;" type="submit" name="cafe_edit_direct" class="btn btn-danger" >Edit Data</button></a>
          <button style="margin-top: 5%;" type="submit" name="admin_sign_out" class="btn btn-danger" >Log Out</button>
      </div>
    </fieldset>
  </form>
</center>

</div>
</div>

</body>
</html>
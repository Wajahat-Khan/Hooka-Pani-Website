<?php 
include 'connect.php';
?>
<?php 
if(isset($_POST["login"])){
    $id= $_POST["login-id"];
    $pass=$_POST["login-password"];
    $_SESSION["id"]=$id;
    //echo $_SESSION["id"];
    $query="select * from users where ID = $id";
    $result=$conn->query($query);
    //echo mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    if($row){
    if($row["password"]==$pass){
        echo "<script type=text/javascript>  alert('You are logged in'); </script>"; 
        }
    else echo "<script type=text/javascript>  alert('Wrong Password!'); </script>";
    }
    else echo "<script type=text/javascript>  alert('Invalid User!'); </script>";   
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NUST CAFE's</title>
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


    <!-- Carousel -->


    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding-top: 0px; margin-top: 0px;z-index: -1">
        <!-- Indicators -->

        <!-- Wrapper for slides -->
        <div class="carousel-inner" style="width: 100%; height: 500px;">
            <div class="item active" style="width: 100%; height: 500px;">
                <img src="img/c1-2.jpg" alt="c1" style="width:100%; height: 100%;">
            </div>

            <div class="item" style="width: 100%; height: 500px;">
                <img src="img/c1.jpg" alt="c1" style="width:100%; height: 100%;">
            </div>

            <div class="item" style="width: 100%; height: 500px;">
                <img src="img/c2.jpg" alt="c2" style="width:100%; height: 100%;">
            </div>

            <div class="item" style="width: 100%; height: 500px;">
                <img src="img/jango.jpg" alt="jango" style="width:100%; height: 100%;">
            </div>

            <div class="item" style="width: 100%; height: 500px;">
                <img src="img/309.jpg" alt="309" style="width:100%; height: 100%;">
            </div>
        </div>

    </div>

    <div class="container">
        <div name="cafe" class="row">
            <div class="col-md-12">
                <center>
                    <h1>NUST CAFE's</h1>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 heffect">
                <img src="img/309.jpg" alt="309" class="img-responsive gallery image">
                <div class="middle">
                    <a href="309.html" target="_blank">
                        <div class="text"><i>Cafe 309</i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 heffect">
                <img src="img/c2.jpg" alt="c2" class="img-responsive gallery image">
                <div class="middle">
                    <a href="c2.html" target="_blank">
                        <div class="text"><i>Concordia 2</i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 heffect">
                <img src="img/wall.jpg" alt="wall" class="img-responsive gallery image">
                <div class="middle">
                    <a href="wall.html" target="_blank">
                        <div class="text"><i>The Wall</i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 heffect">
                <img src="img/jango.jpg" alt="jango" class="img-responsive gallery image">
                <div class="middle">
                    <a href="jango.html" target="_blank">
                        <div class="text"><i>Jango</i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-lg-offset-3 heffect">
                <img src="img/c1-2.jpg" alt="c1"  class="img-responsive gallery image">
                <div class="middle">
                    <a href="jango.html" target="_blank">
                        <div class="text"><i>Jango</i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

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
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.js"></script>
    <script>
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                testAPI();
            } else {
                // The person is not logged into your app or we are unable to tell.
                document.getElementById('status').innerHTML = ' ' +
                    '';
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId: '200678680495680',
                cookie: true, // enable cookies to allow the server to access
                // the session
                xfbml: true, // parse social plugins on this page
                version: 'v2.10' // use graph api version 2.8
            });


            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });

        };

        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        function testAPI() {
            console.log(' ');
            FB.api('/me', function(response) {
                console.log('' + response.name);
                document.getElementById('status').innerHTML =
                    ' ' + response.name + '!';
            });
        }
    </script>
</body>

</html>
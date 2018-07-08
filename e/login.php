<?php require_once('Connections/BooksLib.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_BooksLib, $BooksLib);
$query_login = "SELECT * FROM LogIn";
$login = mysql_query($query_login, $BooksLib) or die(mysql_error());
$row_login = mysql_fetch_assoc($login);
$totalRows_login = mysql_num_rows($login);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Usernametextfield'])) {
  $loginUsername=$_POST['Usernametextfield'];
  $password=$_POST['passwordtextfield'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admin.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_BooksLib, $BooksLib);
  
  $LoginRS__query=sprintf("SELECT UserName, Password FROM LogIn WHERE UserName=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $BooksLib) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html>

    <head>
	<link rel="stylesheet" href="css/boilerplate.css">
	<link rel="stylesheet" href="css/cmslogin.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div align="center" id="heading" class="clearfix">
            
            <img src = "images/logo.png" width="224px" height="80px" alt="" longdesc="images/logo.png" />
        </div>
        <div id="form" class="clearfix">
            <div id="box" class="clearfix">
                <p id="text1">
                Log In
                </p>
                <div id="box1" class="clearfix">
                <form ACTION="<?php echo $loginFormAction; ?>" method="POST" id="loginform">
                <table width="100%">
                  <tr align="center">
                    <td>User Name</td>
                    <td><label for="Username_textfield"></label>
                    <input type="text" name="Usernametextfield" id="Username_textfield"></td>
                  </tr>
                  <tr align="center">
                    <td>Password</td>
                    <td><label for="password_textfield"></label>
                    <input type="password" name="passwordtextfield" id="password_textfield"></td>
                  </tr>
                  <tr align="center">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td>&nbsp;</td>
                    <td><input class="btn" type="submit" name="submitbutton" id="submitbutton" value="Log In"></td>
                  </tr>
                </table>

                
                </form>
                
                </div>
            </div>
        </div>
        <div id="footer" class="clearfix">
            <p id="text2">
            Copyright 2017 &#x7c;
            </p>
        </div>
    </div>
    </body>
</html>
<?php
mysql_free_result($login);
?>

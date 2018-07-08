<?php require_once('Connections/BooksLib.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editauthor")) {
  $updateSQL = sprintf("UPDATE AUTHOR SET Author_Name=%s, Address=%s, Qualification=%s WHERE AuthorID=%s",
                       GetSQLValueString($_POST['authorname'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['qualification'], "text"),
                       GetSQLValueString($_POST['authorid'], "int"));

  mysql_select_db($database_BooksLib, $BooksLib);
  $Result1 = mysql_query($updateSQL, $BooksLib) or die(mysql_error());

  $updateGoTo = "addauthor.php?ID=" . $row_AuthorQuery['AuthorID'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_AuthorQuery = "-1";
if (isset($_GET['ID'])) {
  $colname_AuthorQuery = $_GET['ID'];
}
mysql_select_db($database_BooksLib, $BooksLib);
$query_AuthorQuery = sprintf("SELECT * FROM AUTHOR WHERE AuthorID = %s", GetSQLValueString($colname_AuthorQuery, "int"));
$AuthorQuery = mysql_query($query_AuthorQuery, $BooksLib) or die(mysql_error());
$row_AuthorQuery = mysql_fetch_assoc($AuthorQuery);
$totalRows_AuthorQuery = mysql_num_rows($AuthorQuery);
?>
<!DOCTYPE html>
<html>

    <head>
	<link rel="stylesheet" href="css/boilerplate.css">
	<link rel="stylesheet" href="css/cms.css">
    <link rel="stylesheet" href="css/cms2.css">
    <script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    <title>Edit Author | Library.com</title>
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="main-nav" class="clearfix">
        	<ul>
              <li><a href="admin.php">Admin</a></li>
              <li><a href="inbox.php">Inbox</a></li>
              <li><a href="addbook.php">Books</a></li>
			  <li><a href="addauthor.php">Authors</a></li>
			  <li><a href="addcategory.php">Categories</a></li>
              <li><a href="directories.php">Directories</a></li>
              <li><a href="details.php">Details</a></li>
              <li><a href="<?php echo $logoutAction ?>">Log Out</a></li>
            </ul>
        
        </div>
         <div id="heading" class="clearfix">
            <div align="center" id="heading" class="clearfix">
             <img src = "images/logo.png" width="224px" height="80px" alt="" longdesc="images/logo.png" />
        </div></div>
        <div id="form">
        <p id="text1">Edit Author: <?php echo $row_AuthorQuery['Author_Name']; ?></p> 
        <br/>
        <br/>
        
        <form action="<?php echo $editFormAction; ?>" name="editauthor" method="POST" id="editauthor">
        <input name="idhidden" type="hidden">
        <table align="center" width="800px">
          <tr>
            <th width="250" scope="row">Author ID:</th>
            <td><input name="authorid" type="text" class="btn" value="<?php echo $row_AuthorQuery['AuthorID']; ?>"></td>
          </tr>
          <tr>
            <th scope="row">Author Name:</th>
            <td><input name="authorname" type="text" class="btn" value="<?php echo $row_AuthorQuery['Author_Name']; ?>"></td>
          </tr>
          <tr>
            <th scope="row">Address:</th>
            <td><input name="address" type="text" class="btn" value="<?php echo $row_AuthorQuery['Address']; ?>"></td>
          </tr>
		   <tr>
            <th scope="row">Qualification:</th>
            <td><input name="qualification" type="text" class="btn" value="<?php echo $row_AuthorQuery['Qualification']; ?>"></td>
          </tr>
		  

          
          <tr>
            <th scope="row">&nbsp;</th>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th scope="row">&nbsp;</th>
            <td><input name="buttonSubmit" type="submit" class="btn" id="buttonSubmit" value="Update"></td>
          </tr>
          <tr>
            <th scope="row">&nbsp;</th>
            <td>&nbsp;</td>
          </tr>
          </table>
        <input type="hidden" name="MM_update" value="editauthor">
        </form>
        <br />
        <div class="center3">
        <ul>
              <li><a href="addauthor.php">Back</a></li>
              <li><a href="addauthor.php?ID=<?php echo $row_AuthorQuery['AuthorID']; ?>">Next</a></li>
        </ul>
            </div>
        </div>
        <div id="footer" class="clearfix">
            <p id="text3">
           Copyrights @ Library.com;
            </p>
        </div>
    </div>
    </body>
</html>
<?php
mysql_free_result($AuthorQuery);
?>

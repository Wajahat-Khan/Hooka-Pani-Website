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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addAuthor")) {
  $insertSQL = sprintf("INSERT INTO AUTHOR (Author_Name) VALUES (%s)",
                       GetSQLValueString($_POST['textfield'], "text"));

  mysql_select_db($database_BooksLib, $BooksLib);
  $Result1 = mysql_query($insertSQL, $BooksLib) or die(mysql_error());

  $insertGoTo = "addauthor.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_BooksLib, $BooksLib);
$query_AddAuthor = "SELECT * FROM AUTHOR ORDER BY `AuthorID` ASC";
$AddAuthor = mysql_query($query_AddAuthor, $BooksLib) or die(mysql_error());
$row_AddAuthor = mysql_fetch_assoc($AddAuthor);
$totalRows_AddAuthor = mysql_num_rows($AddAuthor);
?>
<!DOCTYPE html>
<html>

    <head>
	<link rel="stylesheet" href="css/boilerplate.css">
	<link rel="stylesheet" href="css/cms.css">
    <link rel="stylesheet" href="css/cms2.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    <title>Add Author | Library.com</title>
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="main-nav" class="clearfix">
        	<ul>
              <li><a href="admin.php">Admin</a></li>
              <li><a href="inbox.php">Inbox</a></li>
              <li><a href="addbook.php">Books</a></li>
			  <li id="active">Authors</a></li>
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
        <p id="text1">Add Author</p> <br/>
        <br/>
        
        <form name="addAuthor" action="<?php echo $editFormAction; ?>" method="POST" id="addAuthor">
        <table width="500px" align="center">
          <tr>
            <td align="center"><label for="textfield"></label>
            <input name="textfield" type="text" class="btn" id="textfield"></td>
            <td align="center"><input name="buttonSubmit" type="submit" class="btn" id="buttonSubmit" value="Add New Author"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="addAuthor">

        
        </form>
        
        <br/>
        
        <table width="100%" border="1">
          <tr align="center">
            <th scope="col">AuthorID</th>
            <th scope="col">Author Name</th>
            <th scope="col">Address</th>
			 <th scope="col">Qualification</th>
            <th scope="col">Check Details</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
          <?php do { ?>
          <tr align="center">
            <td>&nbsp;<?php echo $row_AddAuthor['AuthorID']; ?></td>
            <td>&nbsp;<?php echo $row_AddAuthor['Author_Name']; ?></td>
            <td>&nbsp;<?php echo $row_AddAuthor['Address']; ?></td>
            <td>&nbsp;<?php echo $row_AddAuthor['Qualification']; ?></td>
            <td width="120px"><a href="authorcmsdetail.php?ID=<?php echo $row_AddAuthor['AuthorID']; ?>">Details</a></td>
            <td width="120px"><a href="editauthor.php?ID=<?php echo $row_AddAuthor['AuthorID']; ?>">Edit</a></td>
            <td width="120px"><a href="deleteauthor.php?ID=<?php echo $row_AddAuthor['AuthorID']; ?>">Delete</a></td>
          </tr>
            <?php } while ($row_AddAuthor = mysql_fetch_assoc($AddAuthor)); ?>
        </table>

        
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
mysql_free_result($AddAuthor);
?>

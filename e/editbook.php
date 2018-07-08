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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editbook")) {
  $updateSQL = sprintf("UPDATE BOOKS SET BookName=%s, PublisherID=%s, AuthorID=%s, CategoryID=%s, SupID=%s, Book_Img=%s, Book_PDF=%s WHERE BookID=%s",
                       GetSQLValueString($_POST['bookname'], "text"),
                       GetSQLValueString($_POST['publisherid'], "int"),
                       GetSQLValueString($_POST['authorid'], "int"),
                       GetSQLValueString($_POST['categoryid'], "int"),
					    GetSQLValueString($_POST['supplierid'], "int"),
						GetSQLValueString($_POST['b_cover'], "text"),
						GetSQLValueString($_POST['b_pdf'], "text"),
                       GetSQLValueString($_POST['bookid'], "int"));

  mysql_select_db($database_BooksLib, $BooksLib);
  $Result1 = mysql_query($updateSQL, $BooksLib) or die(mysql_error());

  $updateGoTo = "addbook.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_editBook = "-1";
if (isset($_GET['ID'])) {
  $colname_editBook = $_GET['ID'];
}
mysql_select_db($database_BooksLib, $BooksLib);
$query_editBook = sprintf("SELECT * FROM BOOKS WHERE BookID = %s", GetSQLValueString($colname_editBook, "int"));
$editBook = mysql_query($query_editBook, $BooksLib) or die(mysql_error());
$row_editBook = mysql_fetch_assoc($editBook);
$totalRows_editBook = mysql_num_rows($editBook);
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
    <title>Edit Book | CMS HF</title>
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
        <p id="text1">Edit Book: </p> <br/>
        <br/>
        
        <form action="<?php echo $editFormAction; ?>" name="editbook" method="POST" id="editbook">
        <input name="idhidden" type="hidden">
        <table align="center" width="800px">
          <tr>
            <th width="250" scope="row">Book ID:</th>
            <td><input name="bookid" type="text" class="btn" value="<?php echo $row_editBook['BookID']; ?>"></td>
          </tr>
          <tr>
            <th scope="row">Book Name:</th>
            <td><input name="bookname" type="text" class="btn" value="<?php echo $row_editBook['BookName']; ?>"></td>
          </tr>
          <tr>
            <th scope="row">Publisher ID:</th>
            <td><input name="publisherid" type="text" class="btn" value="<?php echo $row_editBook['PublisherID']; ?>"></td>
          </tr>
		   <tr>
            <th scope="row">Supplier ID:</th>
            <td><input name="supplierid" type="text" class="btn" value="<?php echo $row_editBook['SupID']; ?>"></td>
          </tr>
		  <tr>
            <th scope="row">Author ID:</th>
            <td><input name="authorid" type="text" class="btn" value="<?php echo $row_editBook['AuthorID']; ?>"></td>
          </tr>
		  <tr>
            <th scope="row">Category ID:</th>
            <td><input name="categoryid" type="text" class="btn" value="<?php echo $row_editBook['CategoryID']; ?>"></td>
          </tr>
		  <tr>
            <th scope="row">Book Cover:</th>
            <td><input name="b_cover" type="text" class="btn" value="<?php echo $row_editBook['Book_Img']; ?>"></td>
          </tr>
		  <tr>
            <th scope="row">PDF:</th>
            <td><input name="b_pdf" type="text" class="btn" value="<?php echo $row_editBook['Book_PDF']; ?>"></td>
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
        <input type="hidden" name="MM_update" value="editbook">
        </form>
        <br />
        <div class="center3">
        <ul>
              <li><a href="addbook.php">Back</a></li>
              <li><a href="editbook.php?ID=<?php echo $row_editBook['BookID']; ?>">Next</a></li>
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
mysql_free_result($editBook);
?>

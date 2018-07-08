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

$MM_restrictGoTo = "login.php";
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_inbox = 5;
$pageNum_inbox = 0;
if (isset($_GET['pageNum_inbox'])) {
  $pageNum_inbox = $_GET['pageNum_inbox'];
}
$startRow_inbox = $pageNum_inbox * $maxRows_inbox;

mysql_select_db($database_BooksLib, $BooksLib);
$query_inbox = "SELECT * FROM contact ORDER BY `Date` DESC";
$query_limit_inbox = sprintf("%s LIMIT %d, %d", $query_inbox, $startRow_inbox, $maxRows_inbox);
$inbox = mysql_query($query_limit_inbox, $BooksLib) or die(mysql_error());
$row_inbox = mysql_fetch_assoc($inbox);

if (isset($_GET['totalRows_inbox'])) {
  $totalRows_inbox = $_GET['totalRows_inbox'];
} else {
  $all_inbox = mysql_query($query_inbox);
  $totalRows_inbox = mysql_num_rows($all_inbox);
}
$totalPages_inbox = ceil($totalRows_inbox/$maxRows_inbox)-1;

$maxRows_books = 25;
$pageNum_books = 0;
if (isset($_GET['pageNum_books'])) {
  $pageNum_books = $_GET['pageNum_books'];
}
$startRow_books = $pageNum_books * $maxRows_books;

mysql_select_db($database_BooksLib, $BooksLib);
$query_books = "SELECT * FROM BOOKS ORDER BY BookID DESC";
$query_limit_books = sprintf("%s LIMIT %d, %d", $query_books, $startRow_books, $maxRows_books);
$books = mysql_query($query_limit_books, $BooksLib) or die(mysql_error());
$row_books = mysql_fetch_assoc($books);

if (isset($_GET['totalRows_books'])) {
  $totalRows_books = $_GET['totalRows_books'];
} else {
  $all_books = mysql_query($query_books);
  $totalRows_books = mysql_num_rows($all_books);
}
$totalPages_books = ceil($totalRows_books/$maxRows_books)-1;

$queryString_books = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_books") == false && 
        stristr($param, "totalRows_books") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_books = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_books = sprintf("&totalRows_books=%d%s", $totalRows_books, $queryString_books);
?>
<!DOCTYPE html>
<html>

    <head>
	<link rel="stylesheet" href="css/boilerplate.css">
	<link rel="stylesheet" href="css/cms.css">
    <link rel="stylesheet" href="css/cms2.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    <title>Admin | Library.com</title>
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="main-nav" class="clearfix">
        	<ul>
              <li id="active">Admin</li>
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
        <div id="stats" class="clearfix">
            <p id="text1">
            Mails
          </p>
       
            <div id="statscontetn" class="clearfix">
              <?php do { ?>
                <p><strong>Name:</strong> <?php echo $row_inbox['Name']; ?></p>
                <p><strong>Message: </strong> <?php echo $row_inbox['Text']; ?></p>
                <br/>
                <div class="center2"> <a href="inboxmessage.php?ID=<?php echo $row_inbox['ID']; ?>">Check</a></div>
                <hr>
                <?php } while ($row_inbox = mysql_fetch_assoc($inbox)); ?>
          </div>
        </div>
        <div id="books" class="clearfix">
            <p id="text2">
            Books
            </p>
            <div id="table-books" class="clearfix">
            <table width="100%" border="1">
              <tr align="center">
                <th scope="col">ID</th>
                <th scope="col">Book Name</th>
                <th scope="col">Author</th>
                <th width="120px" scope="col">Edit</th>
                <th width="120px" scope="col">Delete</th>
              </tr>
              <?php do { ?>
                <?php if ($totalRows_books > 0) { // Show if recordset not empty ?>
                  <tr align="center">
                    <td><?php echo $row_books['BookID']; ?></td>
                    <td><?php echo $row_books['BookName']; ?></td>
                    <td><?php echo $row_books['AuthorID']; ?></td>
                    <td><a href="editbook.php?ID=<?php echo $row_books['BookID']; ?>">Edit</a></td>
                    <td><a href="deletebook.php?ID=<?php echo $row_books['BookID']; ?>">Delete</a></td>
                  </tr>
                  <?php } // Show if recordset not empty ?>
                <?php } while ($row_books = mysql_fetch_assoc($books)); ?>
            </table>
            <br/>
            <div class="center">
            <ul>
              <li><a href="<?php printf("%s?pageNum_books=%d%s", $currentPage, 0, $queryString_books); ?>">First</a></li>
              <li><a href="<?php printf("%s?pageNum_books=%d%s", $currentPage, max(0, $pageNum_books - 1), $queryString_books); ?>">Back</a></li>
              <li><a href="<?php printf("%s?pageNum_books=%d%s", $currentPage, min($totalPages_books, $pageNum_books + 1), $queryString_books); ?>">Next</a></li>
              <li><a href="<?php printf("%s?pageNum_books=%d%s", $currentPage, $totalPages_books, $queryString_books); ?>">Last</a></li>
            </ul>
            </div>

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
mysql_free_result($inbox);

mysql_free_result($books);
?>

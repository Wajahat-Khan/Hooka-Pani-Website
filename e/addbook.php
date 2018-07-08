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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addBook")) {
  $insertSQL = sprintf("INSERT INTO BOOKS (BookName, PublisherID, AuthorID, CategoryID, SupID) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['bookname'], "text"),
                       GetSQLValueString($_POST['PublisherID'], "int"),
                       GetSQLValueString($_POST['AuthorID'], "int"),
                       GetSQLValueString($_POST['CategoryID'], "int"),
                       GetSQLValueString($_POST['SupID'], "int"));

  mysql_select_db($database_BooksLib, $BooksLib);
  $Result1 = mysql_query($insertSQL, $BooksLib) or die(mysql_error());

  $insertGoTo = "addbook.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_BooksLib, $BooksLib);
$query_AddBook = "SELECT * FROM BOOKS ORDER BY BookID ASC";
$AddBook = mysql_query($query_AddBook, $BooksLib) or die(mysql_error());
$row_AddBook = mysql_fetch_assoc($AddBook);
$totalRows_AddBook = mysql_num_rows($AddBook);

mysql_select_db($database_BooksLib, $BooksLib);
$query_Publisher = "SELECT * FROM PUBLISHER";
$Publisher = mysql_query($query_Publisher, $BooksLib) or die(mysql_error());
$row_Publisher = mysql_fetch_assoc($Publisher);
$totalRows_Publisher = mysql_num_rows($Publisher);

mysql_select_db($database_BooksLib, $BooksLib);
$query_Author = "SELECT * FROM AUTHOR";
$Author = mysql_query($query_Author, $BooksLib) or die(mysql_error());
$row_Author = mysql_fetch_assoc($Author);
$totalRows_Author = mysql_num_rows($Author);

mysql_select_db($database_BooksLib, $BooksLib);
$query_Category = "SELECT * FROM CATEGORY";
$Category = mysql_query($query_Category, $BooksLib) or die(mysql_error());
$row_Category = mysql_fetch_assoc($Category);
$totalRows_Category = mysql_num_rows($Category);

mysql_select_db($database_BooksLib, $BooksLib);
$query_Sup = "SELECT * FROM SUPPLIER";
$Sup = mysql_query($query_Sup, $BooksLib) or die(mysql_error());
$row_Sup = mysql_fetch_assoc($Sup);
$totalRows_Sup = mysql_num_rows($Sup);
?>
<!DOCTYPE html>
<html>

    <head>
	<link rel="stylesheet" href="css/boilerplate.css">
	<link rel="stylesheet" href="css/cms.css">
    <link rel="stylesheet" href="css/cms2.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    <title>Add Book | CMS HF</title>
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="main-nav" class="clearfix">
        	<ul>
              <li><a href="admin.php">Admin</a></li>
              <li><a href="inbox.php">Inbox</a></li>
              <li id="active">Books</li>
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
        <p id="text1">Add Book</p> <br/>
        <br/>
        
        <form name="addBook" action="<?php echo $editFormAction; ?>" method="POST" id="addBook">
        <table width="500px" align="center">
          <tr>
            <td align="center">Book Name:</td>
            <td align="center"><label for="bookname"></label>
            <input name="bookname" type="text" class="btn" id="textfield"></td>
          </tr>
          <tr>
            <td align="center">Publisher Name:</td>
            <td align="center"><select name="PublisherID">
              <?php
do {  
?>
              <option value="<?php echo $row_Publisher['PubID']?>"><?php echo $row_Publisher['Publisher_Name']?></option>
              <?php
} while ($row_Publisher = mysql_fetch_assoc($Publisher));
  $rows = mysql_num_rows($Publisher);
  if($rows > 0) {
      mysql_data_seek($Publisher, 0);
	  $row_Publisher = mysql_fetch_assoc($Publisher);
  }
?>
            </select></td>
          </tr>
          <tr>
            <td align="center">Author Name:</td>
            <td align="center"><select name="AuthorID">
              <?php
do {  
?>
              <option value="<?php echo $row_Author['AuthorID']?>"><?php echo $row_Author['Author_Name']?></option>
              <?php
} while ($row_Author = mysql_fetch_assoc($Author));
  $rows = mysql_num_rows($Author);
  if($rows > 0) {
      mysql_data_seek($Author, 0);
	  $row_Author = mysql_fetch_assoc($Author);
  }
?>
            </select></td>
          </tr>
          <tr>
            <td align="center">Category Name:</td>
            <td align="center"><select name="CategoryID">
              <?php
do {  
?>
              <option value="<?php echo $row_Category['CategoryID']?>"><?php echo $row_Category['Category_Name']?></option>
              <?php
} while ($row_Category = mysql_fetch_assoc($Category));
  $rows = mysql_num_rows($Category);
  if($rows > 0) {
      mysql_data_seek($Category, 0);
	  $row_Category = mysql_fetch_assoc($Category);
  }
?>
            </select></td>
          </tr>
          <tr>
            <td align="center">Supplier Name:</td>
            <td align="center"><select name="SupID" title="<?php echo $row_AddBook['SupID']; ?>">
              <?php
do {  
?>
              <option value="<?php echo $row_Sup['SupID']?>"><?php echo $row_Sup['Supplier_Name']?></option>
              <?php
} while ($row_Sup = mysql_fetch_assoc($Sup));
  $rows = mysql_num_rows($Sup);
  if($rows > 0) {
      mysql_data_seek($Sup, 0);
	  $row_Sup = mysql_fetch_assoc($Sup);
  }
?>
            </select></td>
          </tr>
          
          <tr>
            <td></td>
            <td align="center"><input name="buttonSubmit" type="submit" class="btn" id="buttonSubmit" value="Add New Book"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="addBook">

        
        </form>
        
        <br/>
        
        <table width="100%" border="1">
          <tr align="center">
            <th scope="col">Book ID</th>
            <th scope="col">Book Name</th>
            <th scope="col">Publisher ID</th>
			 <th scope="col">Supplier ID</th>
            <th scope="col">Author ID</th>
			 <th scope="col">Category ID</th>
            <th scope="col">Check Details</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
          <?php do { ?>
          <tr align="center">
            <td>&nbsp;<?php echo $row_AddBook['BookID']; ?></td>
            <td>&nbsp;<?php echo $row_AddBook['BookName']; ?></td>
            <td>&nbsp;<?php echo $row_AddBook['PublisherID']; ?></td>
            <td>&nbsp;<?php echo $row_AddBook['SupID']; ?></td>
			<td>&nbsp;<?php echo $row_AddBook['AuthorID']; ?></td>
			<td>&nbsp;<?php echo $row_AddBook['CategoryID']; ?></td>
            <td width="120px"><a href="bookscmsdetail.php?ID=<?php echo $row_AddBook['BookID']; ?>">Details</a></td>
            <td width="120px"><a href="editbook.php?ID=<?php echo $row_AddBook['BookID']; ?>">Edit</a></td>
            <td width="120px"><a href="deletebook.php?ID=<?php echo $row_AddBook['BookID']; ?>">Delete</a></td>
          </tr>
            <?php } while ($row_AddBook = mysql_fetch_assoc($AddBook)); ?>
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
mysql_free_result($AddBook);

mysql_free_result($Publisher);

mysql_free_result($Author);

mysql_free_result($Category);

mysql_free_result($Sup);
?>

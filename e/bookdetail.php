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

$colname_detailbook = "-1";
if (isset($_GET['ID'])) {
  $colname_detailbook = $_GET['ID'];
}
mysql_select_db($database_BooksLib, $BooksLib);
$query_detailbook = sprintf("SELECT * FROM QUERY_V_RECORD WHERE BookID = %s", GetSQLValueString($colname_detailbook, "int"));
$detailbook = mysql_query($query_detailbook, $BooksLib) or die(mysql_error());
$row_detailbook = mysql_fetch_assoc($detailbook);
$totalRows_detailbook = mysql_num_rows($detailbook);

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_library = 12;
$pageNum_library = 0;
if (isset($_GET['pageNum_library'])) {
  $pageNum_library = $_GET['pageNum_library'];
}
$startRow_library = $pageNum_library * $maxRows_library;

mysql_select_db($database_BooksLib, $BooksLib);
$query_library = "SELECT * FROM QUERY_V_RECORD ORDER BY `BookID` ASC";
$query_limit_library = sprintf("%s LIMIT %d, %d", $query_library, $startRow_library, $maxRows_library);
$library = mysql_query($query_limit_library, $BooksLib) or die(mysql_error());
$row_library = mysql_fetch_assoc($library);

if (isset($_GET['totalRows_library'])) {
  $totalRows_library = $_GET['totalRows_library'];
} else {
  $all_library = mysql_query($query_library);
  $totalRows_library = mysql_num_rows($all_library);
}


$queryString_library = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_library") == false && 
        stristr($param, "totalRows_library") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_library = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_library = sprintf("&totalRows_library=%d%s", $totalRows_library, $queryString_library);
?>
<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Novel, Book, Pdf, pdf, <?php echo $row_detailbook['BookName']; ?>, <?php echo $row_detailbook['Author_Name']; ?>">
<meta name="description" content="A great book (<?php echo $row_detailbook['BookName']; ?>) written by <?php echo $row_detailbook['Author_Name']; ?>. Download for free in PDF format.">


<title><?php echo $row_detailbook['BookName']; ?> | Library.com</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/coverdesign.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=663833720350513";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="container">
  <div class="banner">
    <div class="logo"><a href="index.php"><img src="images/logo.png" width="224" height="70" alt="" longdesc="images/logo.png" /></a></div>
    <div class="nav_buttons">
       
       <a class="navpic" href="contact.php"><img src="nav/mail_2.png" width="95" height="95"></a>
        <a class="navpic" href="library.php"><img src="nav/pdf.png" width="95" height="95"></a>
        <a class="navpic" href="index.php"><img src="nav/home (1).png" width="95" height="95"></a>
       
    </div>
  </div>
  <div class="sub-heading">
		<h1><?php echo $row_detailbook['BookName']; ?></h1>
  </div>
  
  
  <div class="main">
    <div align="left" class="coverbookdiv"><a href="books/<?php echo $row_detailbook['Book_PDF']; ?>.pdf"><img class="coverbook morph" src="images/<?php echo $row_detailbook['Book_Img']; ?>" width="265" height="400"></a></div>
    <div class="bookname">
    	<h5><strong>Book Name:</strong></h5>
        <p><?php echo $row_detailbook['BookName']; ?></p>
        <h5><strong>Author Name:</strong></h5>
		<p><?php echo $row_detailbook['Author_Name']; ?></p>
        <h5><strong>Genres:</strong></h5>
		<p><?php echo $row_detailbook['Category_Name']; ?></p>
    </div>
    <div class="review">
    	<h5><strong>Review:</strong></h5>
    	<p><?php echo $row_detailbook['Review']; ?></p>
    	<p>&nbsp;</p>
    	<h5>Click on the cover to read the book.</h5>
    	
  </div>
  
  
  <div class="formsbase">
    <div class="SearchA">
    	<div align="center" id="search">
<form action="searchauthor.php" method="post">
	  <input class="textboxS" type="text" name="searchauthor" placeholder="Search an Author..." />
	  <input class="buttonS" type="submit" value="Search by Author" />
</form>

		</div> <!--Search Author-->
	</div>
    <div class="searchB">
    	<div align="center" id="search">
			<form action="search.php" method="post">
    	<input class="buttonS" type="submit" value="Search A Book" />
	  <input class="textboxS" type="text" name="search" placeholder="Search a book..." />
</form>
		</div> <!--Search Book-->
	</div>
    
    <div class="gendraform">
   		<form action="gendra.php" method="post" name="gendraforms">
      
      <select class="textboxS" name="gendra">
      <option selected="selected">--- Genres ---</option>
      <option value="Fantasy">Fantasy</option>
      <option value="Romance">Romance</option>
      <option value="Children">Children</option>
      <option value="Action">Action</option>
      <option value="Young Adult">Young Adult</option>
      <option value="Strategy">Strategy</option>
      <option value="Fiction">Fiction</option>
      <option value="Thriller">Thriller</option>
      <option value="Crime">Crime</option>
      <option value="Non Fiction">Non Fiction</option>
      <option value="Mystery">Mystery</option>
      <option value="Adventure">Adventure</option></select>
	  <input type="submit" class="buttonS" name="buttonsAlpha" id="buttonsAlpha" value="Search By Genre">
      </form>
    </div>
    <div class="footer">&copy; Copyright | Library.com | 2017
	 
	 <p> Muhammad Kaab </p>
	 <p> Basim Mannan </p>
	 <p> Talha Mahmood </p>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($detailbook);
?>

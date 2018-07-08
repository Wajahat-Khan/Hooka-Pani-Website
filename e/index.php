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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_addImages = 12;
$pageNum_addImages = 0;
if (isset($_GET['pageNum_addImages'])) {
  $pageNum_addImages = $_GET['pageNum_addImages'];
}
$startRow_addImages = $pageNum_addImages * $maxRows_addImages;

mysql_select_db($database_BooksLib, $BooksLib);
$query_addImages = "SELECT * FROM BOOKS ORDER BY BookID DESC";
$query_limit_addImages = sprintf("%s LIMIT %d, %d", $query_addImages, $startRow_addImages, $maxRows_addImages);
$addImages = mysql_query($query_limit_addImages, $BooksLib) or die(mysql_error());
$row_addImages = mysql_fetch_assoc($addImages);

if (isset($_GET['totalRows_addImages'])) {
  $totalRows_addImages = $_GET['totalRows_addImages'];
} else {
  $all_addImages = mysql_query($query_addImages);
  $totalRows_addImages = mysql_num_rows($all_addImages);
}
$totalPages_addImages = ceil($totalRows_addImages/$maxRows_addImages)-1;

$queryString_addImages = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_addImages") == false && 
        stristr($param, "totalRows_addImages") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_addImages = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_addImages = sprintf("&totalRows_addImages=%d%s", $totalRows_addImages, $queryString_addImages);
?>
<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home | Library.com</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/slideshow.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

<!--lINK FOR SLIDE sHOW-->

<link rel="stylesheet" type="text/css" href="css/site_global.css?3837790900"/>
  <link rel="stylesheet" type="text/css" href="css/index.css?4234449023" id="pagesheet"/>
<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->  

<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine2/style.css" />
<script type="text/javascript" src="engine2/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->

<!--lINK ENDS-->
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
    <div class="logo"><img src = "images/logo.png" width="224px" height="80px" alt="" longdesc="images/logo.png" /></div>
    <div class="nav_buttons">
        <a class="navpic" href="contact.php"><img src="nav/mail_2.png" width="95" height="95"></a>
        <a class="navpic" href="library.php"><img src="nav/pdf.png" width="95" height="95"></a>
        <a class="active" href="index.php"><img src="nav/home (1).png" width="95" height="95"></a>
    </div>
  </div>
<div class="sub-heading">
    <div id="wowslider-container1">
  	  <div class="ws_images"><ul>
		<li><img src="images/cover_5.jpg"   id="wows1_0"/></li>
		<li><img src="images/cover_1.jpg"   id="wows1_1"/></li>
		<li><img src="images/cover_2.jpg"   id="wows1_2"/></li>
		<li><img src="images/cover_4.jpg"   id="wows1_3"/></li>
		<li><img src="images/cover_3.jpg"   id="wows1_4"/></li>
	</ul></div>
	<div class="ws_shadow"></div>
	</div>
<script type="text/javascript" src="engine1/wowslider.js"></script>
  <script type="text/javascript" src="engine1/script.js"></script>
</div>  
<div class="main">
  <?php if ($totalRows_addImages > 0) { // Show if recordset not empty ?>
    <?php do { ?>
      <div class="book1"><a href="bookdetail.php?ID=<?php echo $row_addImages['BookID']; ?>"><img class="morph pic" src="images/<?php echo $row_addImages['Book_Img']; ?>" width="120" height="170"/></a></div>
      <?php } while ($row_addImages = mysql_fetch_assoc($addImages)); ?>
    <?php } // Show if recordset not empty ?>
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
mysql_free_result($addImages);
?>


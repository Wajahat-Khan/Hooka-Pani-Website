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

$colname_alphabetical = "-1";
if (isset($_POST['alphaOrder'])) {
  $colname_alphabetical = $_POST['alphaOrder'];
}
mysql_select_db($database_BooksLib, $BooksLib);
$query_alphabetical = sprintf("SELECT * FROM Books WHERE ALPHA LIKE %s ORDER BY BookName ASC", GetSQLValueString("%" . $colname_alphabetical . "%", "text"));
$alphabetical = mysql_query($query_alphabetical, $BooksLib) or die(mysql_error());
$row_alphabetical = mysql_fetch_assoc($alphabetical);
$totalRows_alphabetical = mysql_num_rows($alphabetical);

$queryString_alphabetical = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_alphabetical") == false && 
        stristr($param, "totalRows_alphabetical") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_alphabetical = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_alphabetical = sprintf("&totalRows_alphabetical=%d%s", $totalRows_alphabetical, $queryString_alphabetical);
?>
<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alphabetical Order | BooksLib</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
</head>

<body>
<div class="container">
  <div class="banner">
    <div class="logo"><img src="images/logo.png" width="224" height="70" alt="" longdesc="images/logo.png" /></div>
    <div class="nav_buttons"> 
    
    	<a class="navpic" href="contact.php"><img src="nav/mail_2.png" width="95" height="95"></a>
        <a class="navpic" href="library.php"><img src="nav/pdf.png" width="95" height="95"></a>
        <a class="navpic" href="index.php"><img src="nav/home (1).png" width="95" height="95"></a>
    
    </div>
  </div>
  <div class="sub-heading">
    <h1>Alpha Betical Order</h1>

  </div>
  
  
  <div class="main">
  	<div align="center">
    	<table class="TopHead" align="center">
  			<tr id="headertable">
    			<td class="border" align="center" width="150px">Book Cover</td>
    			<td class="border" align="center" width="200px">Book Name | Author</td>
    			<td class="border" align="center" width="300px">Review</td>
    			<td class="border" align="center" width="150px">Read Book</td>
  			</tr>
		</table>
        <?php do { ?>
          <?php if ($totalRows_alphabetical > 0) { // Show if recordset not empty ?>
  <table width="0" border="0" align="center"">
    <tr>
      <td align="center" width="150px" height="200px"><img width="150px" height="200px"src="images/<?php echo $row_alphabetical['CoverName']; ?>"></td>
      <td align="center" width="200px"> <?php echo $row_alphabetical['BookName']; ?> | <?php echo $row_alphabetical['BookAuthor']; ?></td>
      <td align="center" width="300px"><?php echo $row_alphabetical['Review']; ?></td>
      <td align="center" width="150px"><a href="bookdetail.php?ID=<?php echo $row_alphabetical['ID']; ?>">Read Book</a></td><strong></strong>
      </tr>
  </table>
  <?php } // Show if recordset not empty ?>
          <?php } while ($row_alphabetical = mysql_fetch_assoc($alphabetical)); ?>
  	</div>
  </div>
  <div class="formsbase">
      <div class="SearchA">
    	<div align="center" id="search">
<form action="searchauthor.php" method="post">
	
	  <input class="textboxS" type="text" name="searchauthor" placeholder="Search an Author..." />
	  <input class="buttonS" type="submit" value="Search by Author" />
	  
</form>

		</div>
	</div>
    <div class="searchB">
    	<div align="center" id="search">
<form action="search.php" method="post">
	
	  <input class="textboxS" type="text" name="search" placeholder="Search a book..." />
	  <input
      class="buttonS" type="submit" value="Search A Book" />
	  
</form>
		</div>
	</div>
    <div class="alpha">
      <form action="alphabetic.php" method="post" name="alphaform" id="alphaform"><select name="alphaOrder" class="textboxS" id="alphaOrder">
        <option selected>-- Alphabetical Order --</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <option value="H">H</option>
        <option value="I">I</option>
        <option value="J">J</option>
        <option value="K">K</option>
        <option value="L">L</option>
        <option value="M">M</option>
        <option value="N">N</option>
        <option value="O">O</option>
        <option value="P">P</option>
        <option value="Q">Q</option>
        <option value="R">R</option>
        <option value="S">S</option>
        <option value="T">T</option>
        <option value="U">U</option>
        <option value="V">V</option>
        <option value="W">W</option>
        <option value="X">X</option>
        <option value="Y">Y</option>
        <option value="Z">Z</option>
        <option value="#">#</option></select>
        <input type="submit" class="buttonS" name="buttonsAlpha" id="buttonsAlpha" value="Go">
      </form>
    </div>
    <div class="gendraform"><form action="gendra.php" method="post" name="gendraforms"><select class="textboxS" name="gendra">
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
      <input type="submit" class="buttonS" name="buttonsAlpha" id="buttonsAlpha" value="Go">
      </form>
    </div>
  </div>
  
  <div class="footer">&copy; Copyright | BooksLib.tk | 2015</div>
</div>
</body>
</html>
<?php
mysql_free_result($alphabetical);
?>

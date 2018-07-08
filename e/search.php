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

$colname_Books = "-1";
if (isset($_POST['search'])) {
  $colname_Books = $_POST['search'];
}
mysql_select_db($database_BooksLib, $BooksLib);
$query_Books = sprintf("SELECT * FROM QUERY_V_RECORD WHERE BookName LIKE %s", GetSQLValueString("%" . $colname_Books . "%", "text"));
$Books = mysql_query($query_Books, $BooksLib) or die(mysql_error());
$row_Books = mysql_fetch_assoc($Books);
$totalRows_Books = mysql_num_rows($Books);
?>
<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search | Library.com</title>
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
  
  <div class="sub-heading"><h1>Search Results for Books</h1></div>
   
  <div align="center" class="main">
  <table class="TopHead" align="center">
  <tr id="headertable">
    <td class="border" align="center" width="150px">Book Cover</td>
    <td class="border" align="center" width="200px">Book Name | Author</td>
    <td class="border" align="center" width="300px">Review</td>
    <td class="border" align="center" width="150px">Read Book</td>
  </tr>
</table>
<?php do { ?>
  <table width="0" border="0" align="center"">
    
      <tr>
        <td align="center" width="150px" height="200px"><img src="images/<?php echo $row_Books['Book_Img']; ?>" width="130px"></td>
        <td align="center" width="200px"><?php echo $row_Books['BookName']; ?> | <?php echo $row_Books['Author_Name']; ?></td>
        <td align="center" width="300px">Review Goes Here</td>
        <td align="center" width="150px"><a href="bookdetail.php?ID=<?php echo $row_Books['BookID']; ?>">Read Book</a></td>
      </tr>
      
  </table>
  <?php } while ($row_Books = mysql_fetch_assoc($Books)); ?>
  </div>
<div id="footernav">
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
mysql_free_result($Books);
?>


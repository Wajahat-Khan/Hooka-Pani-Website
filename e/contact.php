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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "contactform")) {
  $insertSQL = sprintf("INSERT INTO contact (Name, Email, Text) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['namefield'], "text"),
                       GetSQLValueString($_POST['emailfield'], "text"),
                       GetSQLValueString($_POST['textarea'], "text"));

  mysql_select_db($database_BooksLib, $BooksLib);
  $Result1 = mysql_query($insertSQL, $BooksLib) or die(mysql_error());

  $insertGoTo = "thankyou.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_BooksLib, $BooksLib);
$query_addcontact = "SELECT Name, Email, Text FROM contact";
$addcontact = mysql_query($query_addcontact, $BooksLib) or die(mysql_error());
$row_addcontact = mysql_fetch_assoc($addcontact);
$totalRows_addcontact = mysql_num_rows($addcontact);
?>
<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Contact, Request a Book, Privacy Policy">
<meta name="description" content="Contact: Request a Book or Novel in PDF formats.">


<title>Request a Book or Contact Us |  Library.com</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link href="css/contact2.css" rel="stylesheet" type="text/css">
<script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
</head>

<body>
<div class="container">
  <div class="banner">
    <div class="logo"><img src="images/logo.png" width="224" height="70" alt="" longdesc="images/logo.png" /></div>
    <div class="nav_buttons"> 
    	<a class="active" href="contact.php"><img src="nav/mail_2.png" width="95" height="95"></a>
        <a class="navpic" href="library.php"><img src="nav/pdf.png" width="95" height="95"></a>
        <a class="navpic" href="index.php"><img src="nav/home (1).png" width="95" height="95"></a>
    
    
    </div>
  </div>
  <div class="sub-heading">
		<h1>Request a Book or Contact Us</h1>
  </div>
  
  
  <div class="main">
  
              <form name="contactform" action="<?php echo $editFormAction; ?>" method="POST" id="contactform">
              <div id="formname">
                <h5>&nbsp;</h5>
                <h5>Name:
                
                  <input class="formbars" name="namefield" type="text" id="namefield" maxlength="50">
                </h5>
                <h5>Email:
              
                  <input class="formbars" name="emailfield" type="text" id="emailfield" maxlength="50">
                </h5>
                <h5>Message:
                
                  <textarea class="textarea123" name="textarea" cols="" rows="" id="textarea"></textarea>
				  <script>
					CKEDITOR.replace( 'textarea' );
				  </script>
                </h5>
                <p>
                  <input class="buttonS" name="buttonsubmit" type="submit" value="Submit Request" id="buttonsubmit">
                </p>
              </div>
              <input type="hidden" name="MM_insert" value="contactform">
              </form>
             <div id="privacypolicy">
               <h2><strong>Privacy Policy</strong><br>
               </h2>
               <p>                 If you are affiliated with any government,  police, anti-piracy group or other related group either directly or indirectly,  or were formally a worker, you CANNOT enter these webpages, links, nor access  any of its files and you cannot view any of the HTML, PHP files. If in fact you  are affiliated or were affiliated with the above said groups, by entering this  site you are not agreeing to these terms and you are violating code 431.322.12  of the Internet Privacy Act signed by Bill Clinton I 1995 and that means that  you CANNOT threaten our ISP(s) or any person(s) or company storing these files,  and cannot prosecute any person(s) affiliated with this website. Amendments 9  and 10 of The United States Bill of Rights protect the right to be free of  unwarranted and unwanted government intrusion onto one&rsquo;s personal and private  affairs, papers and possessions. Article 12 of The United Nations Universal Declaration  of Human Rights states, No one shall be subjected to arbitrary interference  with his privacy, family, home or correspondence, nor to attacks upon his honor  and reputation. Everyone has the right to the protection of the law against  such interference or attacks.
               <h2><strong>Security</strong><br>
               </h2>
<p>
  If you discover any of the information  BooksLib holds for you is incorrect or incomplete, that you are unable to  change yourself, please contact us as soon as possible so the necessary changes  can be made.<br>
  </p>

             </div>
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
mysql_free_result($addcontact);
?>

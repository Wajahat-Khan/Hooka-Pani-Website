<?php require_once('Connections/BooksLib.php');
error_reporting(0);
if($_POST['submit'])
{
	$_name=basename ($_FILES['file_upload']['name']);
	$t_name=$_FILES['file_upload']['tmp_name'];
	$dir='images';
	if(move_uploaded_file($t_name,$dir."/".$_name))
	{
		mysql_select_db($database_BooksLib, $BooksLib);
		$qur="insert into books (covername) values ('$_name')";
		$res=mysql_query($qur,$BooksLib);
		echo 'file uploaded successfully.';
	}
	else
	{
		echo 'file upload failed.';
	}
}
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="test.php" method="post" enctype="multipart/form-data">
<input type="file" name="file_upload" />
<input type="submit" name="submit" value="upload"/>
</form>
</body>
</html>


<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_BooksLib = "localhost";
$database_BooksLib = "Library";
$username_BooksLib = "root";
$password_BooksLib = "";
$BooksLib = mysql_connect($hostname_BooksLib, $username_BooksLib, $password_BooksLib) or trigger_error(mysql_error(),E_USER_ERROR);

?>
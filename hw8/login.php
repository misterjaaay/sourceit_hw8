<?php

require_once 'function.php';
require_once 'header.php';

$login = trim ( $_POST ['login'] );
$password = trim ( $_POST ['password'] );

$login = stripslashes($login);
$password = stripslashes($password);
$login = mysql_real_escape_string($login);
$password = mysql_real_escape_string($password);

$login_date = date ( "Y:m:d h:m:s" );

if (isset ( $_POST ['submit'] )) {
	$conn = mysqli_connect ( SERVERNAME, USERNAME, PASSWORD, DBNAME ) or die ( "Connection failed: " . mysqli_connect_error () );

	
	$sql = "SELECT * FROM users WHERE login = '".$login."' AND password = '".sha1 ( 'ololo' . $password )."' ";
	$result = mysqli_query ( $conn, $sql );
	$count = mysqli_num_rows ( $result );

	echo ' <br />';
	
	if ($count == 1) {
		echo "Welcome, ".$login."<br />";
		$sql = "UPDATE users
				SET	 update_at= '" . $login_date . "'
				Where `login` = '".$login."'";
		$result = mysqli_query ( $conn, $sql );
		$_SESSION["login"] = "$login";
		echo "Session variables are set:  ".$_SESSION["login"]."<br />";
		/*cookie*/
	

		$cookie_value = "$login_date";
		setcookie($login, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		
		if(!isset($_COOKIE["$login"])) {
			echo "Cookie '" . $login . "' is not set!";
		} else {
			echo "Cookie '" . $login . "' is set!<br />";
			echo "You have logged in at : " . $_COOKIE["$login"];
		}
		
		
	} else {
		echo 'Wrong username or password <br />';
		echo "Try again or <a href='index.php'>Register</a>";
	}
	 
	mysqli_close ( $conn );
}
	

require_once 'footer.php';

<?php
require_once 'function.php';
require_once 'header.php';

$conn = mysqli_connect ( SERVERNAME, USERNAME, PASSWORD, DBNAME ) or die ( "Connection failed: " . mysqli_connect_error () );


$sql = "SELECT * FROM post where id = '".$_GET['id']."'";
// $sql = "SELECT * FROM post WHERE id = $value";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		echo "<h2> " . $row["title"]. " </h2>" . $row["text"]."<br><br>";
	}
} else {
		echo "0 results";
	}

	mysqli_close($conn);

	
require_once 'footer.php';
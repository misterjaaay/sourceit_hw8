<?php 
require_once 'function.php'; 
require_once 'header.php';


$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, title, description, text FROM post where category_id = '".$_GET['id']."'";
$result = mysqli_query($conn, $sql);



if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    	$post_id = $row["id"];
    	$post_title = $row["title"];
        echo " <h2> <a href='post.php?id=$post_id'>$post_title</a> </h2>";
        echo "id: " . $row["id"]. "  " . $row["title"]. " " . $row["description"]."<br><br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
require_once 'footer.php';
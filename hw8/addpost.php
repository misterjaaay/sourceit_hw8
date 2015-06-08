<form action="addpost.php" method="POST">
	<input type="text" name="login" placeholder="enter your login" required>
	<textarea name="addText" id="" cols="30" rows="10"></textarea>
	 <input type="submit" name="addPost" value="Add post">
</form>
<?php 
require_once 'function.php';
$addtext = $_POST['addText'];
createMainMenu ( getAllCategories () );
$conn = mysqli_connect ( SERVERNAME, USERNAME, PASSWORD, DBNAME );
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO post (text)
VALUES ('$addtext')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

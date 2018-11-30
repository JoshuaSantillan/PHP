<?php
include "connectdb.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tasklist";

// Create connection
$conn = connectdb($servername, $username, $password, $dbname);

if(isset($_POST['list_id']) && isset($_POST['description']) && isset($_POST['completed']))
{
	$list_id = filter_var($_POST['list_id'],FILTER_VALIDATE_INT);
	$description = filter_var($_POST['description'],FILTER_SANITIZE_STRING);
	$completed = filter_var($_POST['completed'],FILTER_SANITIZE_STRING);
	$sql = "INSERT INTO listitem(id, list_id, description,completed) VALUES (NULL, {$list_id},'{$description}','{$completed}')";

	if ($conn->query($sql) === TRUE) {
	    echo "New listitem record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}


}
$conn->close();

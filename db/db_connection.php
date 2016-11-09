<?php 

function connect(){
$servername = "localhost";
$username = "harrydev";
$password = "password";
$dbname = "my_harrydev";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	
	return $conn;
}

	
function query($conn,$sql){
	

$result = $conn->query($sql);
	
	return $result;
}	
	
function isEmpty($result){
	$isEmpty=false;

if (isset($result->num_rows) > 0) {

	$isEmpty=false;
} 
else {
	$isEmpty=true;
}

return $isEmpty;	
}

function close_connection($conn){
	$conn->close();
	
}




			 ?>
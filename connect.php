<?php
	$user_name = "root";
	$password = "";
    $database = "ARD";
    $host_name = "localhost";

    $conn = mysqli_connect($host_name, $user_name,$password,$database);

    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
	
	function sanitize_input($raw_input) //included in all files where user input is expected. Makes input SQL query safe.
{
	global $conn;
	$raw_input = trim($raw_input);
	$raw_input = str_replace("\n","<br>",$raw_input);
	$raw_input = str_replace("\r","",$raw_input);
	$raw_input = stripcslashes($raw_input);
	$raw_input = htmlspecialchars($raw_input);
	$raw_input = mysqli_real_escape_string($conn, $raw_input);
	return $raw_input;
}

?>
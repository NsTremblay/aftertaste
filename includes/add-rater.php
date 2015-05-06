<?php
require_once("header.php");
//this page will hadle the request to add a form

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$name = pg_escape_string($name);
$email = pg_escape_string($email);
$password = pg_escape_string($password);
echo "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')";
if(!pg_query($dbcnx, "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')")){
echo "the user could not be added successfully";
}else{

	header("Location: /index.php");
	echo "Whasaaa";
	exit;

}


?>

<html>

</html>
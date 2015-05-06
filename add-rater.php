<?php
	
	$dbcnx = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=ntrem018 user=ntrem018 password=Bru!nsma2574");

	//this page will hadle the request to add a form

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$name = pg_escape_string($name);
	$email = pg_escape_string($email);
	$password = pg_escape_string($password);

	if(!pg_query($dbcnx, "INSERT INTO rater (name, email, pass, jdate) VALUES ('$name','$email','$password', now())")){
		echo "the user could not be added successfully";
	}else{
		header('location:  index.php');
  		exit();
	}

?>

<html>

</html>
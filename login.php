<?php

$dbcnx = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=ntrem018 user=ntrem018 password=Bru!nsma2574");

$name = $_POST['ml-username'];
$password = $_POST['pwd-password'];
$result = pg_query($dbcnx,"SELECT userid FROM rater WHERE name='$name' AND pass='$password'");
if(pg_num_rows($result)>0){
	$id = pg_fetch_result($result, 0, "userid");
	header("location: index.php?userid=".$id);
	exit;
}else{
	echo "Wrong username and pass";
}


?>

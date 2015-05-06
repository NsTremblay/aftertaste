<?php


$dbcnx = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=ntrem018 user=ntrem018 password=Bru!nsma2574");

//get all the elements
$type = $_POST['type'];
$description = $_POST['description'];
$category = $_POST['category'];
$price = $_POST['price'];
$item = $_POST['item'];
$id = $_POST['id'];
$userid = $_POST['userid'];

$description = pg_escape_string($description);
$price = pg_escape_string($price);
$item = pg_escape_string($item);
//lets add this item to the database
echo "INSERT INTO menuitem (name, type, category, description, price, restid, userid) VALUES ('$item', '$type', '$category', '$description', 
	'$price', $id)";
if(pg_query($dbcnx,"INSERT INTO menuitem (name, type, category, description, price, restid, userid) VALUES ('$item', '$type', '$category', '$description', 
	'$price', $id, $userid)")){
	echo "Success";
}else{
	echo "failed";
}

?>
<?php


$dbcnx = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=ntrem018 user=ntrem018 password=Bru!nsma2574");

//get all the elements
$item = $_POST['item'];
$rating = $_POST['rating'];
$location = $_POST['location'];
if($item){
	if(pg_query($dbcnx,"DELETE FROM menuitem WHERE id=$item")){
		echo "Success";
	}else{
		echo "failed";
	}
}

if($rating){
	if(pg_query($dbcnx,"DELETE FROM rating WHERE id=$rating")){
		echo "Success";
	}else{
		echo "failed";
	}
}

if($location){
	echo "DELETE FROM location WHERE id=$location";
	if(pg_query($dbcnx,"DELETE FROM location WHERE id=$location")){
		echo "Success";
	}else{
		echo "failed";
	}
}

?>
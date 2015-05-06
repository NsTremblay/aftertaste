<?php


$dbcnx = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=ntrem018 user=ntrem018 password=Bru!nsma2574");

//get all the elements
$priceNo = $_POST['priceNo'];
$mood = $_POST['mood'];
$food = $_POST['food'];
$staff = $_POST['staff'];
$item = $_POST['item'];
$id = $_POST['id'];
$userID = $_POST['userid'];
$comment = $_POST['comment'];

$description = pg_escape_string($description);
$price = pg_escape_string($price);
$item = pg_escape_string($item);

$menuItemsString = $_POST['itemsRatings'];
$items = explode(";", $menuItemsString);
$menuItemQuery = "";


echo $menuItemQuery;
//lets add this item to the database
echo "INSERT INTO rating (userid, date, price, food, mood, staff, comments, restid) VALUES ($userID, now(), '$priceNo', '$food', '$mood', '$staff', '$comment', $id)";
if(pg_query($dbcnx,"INSERT INTO rating (userid, date, price, food, mood, staff, comments, restid) VALUES ($userID, now(), '$priceNo', '$food', '$mood', '$staff', '$comment', $id)")){
	for ($i=0; $i < count($items); $i++) { 
		$singleEntry = explode(",", $items[$i]);
		if(strcmp($singleEntry[3], "true")==0){
			$menuItemQuery.="INSERT INTO ratingitem (userid, date, itemid, rating, ratingid) VALUES(".$singleEntry[1].", now(), ".$singleEntry[2].", ".$singleEntry[0].", (SELECT MAX(ID) FROM rating));";
		}
	}
	echo $menuItemQuery;
	if(pg_query($dbcnx, $menuItemQuery)){
		echo "Success";
	}
}else{
	echo "failed";
}
pg_close($dbcnx);


?>
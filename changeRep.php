<?php


$dbcnx = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=ntrem018 user=ntrem018 password=Bru!nsma2574");

//get all the elements
$rater = $_POST['rater'];
$plus = $_POST['plus'];
echo "UPDATE rater SET reputation=reputation+1 WHERE userid=$rater";
if($plus==1){
	if(pg_query($dbcnx,"UPDATE rater SET reputation=reputation+1 WHERE userid=$rater")){
			echo "Success";
	}else{
		echo "failed";
	}
}else if($plus == 0){
	if(pg_query($dbcnx,"UPDATE rater SET reputation=reputation-1 WHERE userid=$rater")){
			echo "Success";
	}else{
		echo "failed";
	}
}
pg_close($dbcnx);
?>
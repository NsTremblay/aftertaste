<?php
header('Content-Type: text/html; charset=utf-8');
$dbcnx = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=ntrem018 user=ntrem018 password=Bru!nsma2574");
pg_set_client_encoding($dbcnx, "UTF-8");
$id = $_GET['id'];
$userid = $_GET['userid'];
//get all the required info in one json file

$timeString ="";

$times = pg_query($dbcnx, "SELECT * FROM times WHERE restid=$id");

if($times){
	while($row = pg_fetch_row($times)){
		$timeString.=$row[1]." - ".$row[2];
		if($row[4]=="sun"){$timeString.="Sunday ";}
		if($row[4]=="mon"){$timeString.="Monday ";}
		if($row[4]=="tue"){$timeString.="Tuesday ";}	
		if($row[4]=="wed"){$timeString.="Wednesday ";}
		if($row[4]=="thu"){$timeString.="Thursday ";}
		if($row[4]=="fri"){$timeString.="Friday ";}
		if($row[4]=="sat"){$timeString.="Saturday ";}
		$timeString.="<br>";
	}
}else{
	echo "Query failed";
}

$generalString;
$generalInfo = pg_query($dbcnx, "SELECT * FROM location WHERE id=$id");

if($generalInfo){
	while($row = pg_fetch_row($generalInfo)){
		//get restaurant info
		if($restaurantInfo = pg_query($dbcnx,"SELECT * FROM restaurant WHERE id = (SELECT restid FROM location WHERE id=$id)")){
			$url = pg_fetch_result($restaurantInfo, 0, "url");
			$generalString.=pg_fetch_result($restaurantInfo, 0, "name")."<br>".pg_fetch_result($restaurantInfo, 0, "type")."<br><a href=\"".$url."\">".$url."</a><br>";
		}

		$generalString.=$row[3]."<br>".$row[2]."<br>Manager : ".$row[9];

	}
}else{
	echo "Query failed";
}

//get menu
$menu;

$menu .= "<div class=\"list-group\">";

$menuItems = pg_query($dbcnx, "SELECT * FROM menuitem WHERE restid=$id");

if($menuItems){
	while($row = pg_fetch_row($menuItems)){
  		$menu .= "<li class=\"list-group-item\">
    		<p class=\"list-group-item-text\">".$row[0]."<br>".money_format('$%i', $row[4])."</p>
    		<p >".$row[2]."</p>";
    		$menuitem = $row[5];
    		//echo "SELECT * FROM rater WHERE userid =(SELECT userid FROM menuitem WHERE id=$menuitem)";
    		if(pg_num_rows(pg_query($dbcnx,"SELECT * FROM menuitem WHERE id=$menuitem and userid=$userid"))>0){
    			$menu.="<!-- Indicates a dangerous or potentially negative action -->
				<button type=\"button\" onClick=\"deleteItem(".$row[5].")\"class=\"btn btn-danger\">Delete</button>";
    		}
    		if($ratingInfo = pg_query($dbcnx, "SELECT CAST(AVG(rating) AS numeric(12,2)) as averageRating FROM ratingitem WHERE itemid=".$row[5]."")){
    			$menu.="Rating :".pg_fetch_result($ratingInfo,0,"averageRating");
    		}
  		$menu .= "</li>";
	}
}else{
	echo "Query failed";
}

$menu .="</div>";

$ratings;

$ratings .="<div class=\"list-group\">";
$ratingsQuery = pg_query($dbcnx, "SELECT * FROM rating WHERE restid=$id");

if($ratingsQuery){
	while($row = pg_fetch_row($ratingsQuery)){
  		$ratings .= "<li class=\"list-group-item\">
    		<p class=\"list-group-item-text\">Price :".$row[1]." Food :".$row[2]." Mood :".$row[3]." Staff :".$row[4]." Comment :".$row[5]."</p>
    		<p >Date added ".$row[0]."</p>";
    		$ratingID = $row[9];
    		$restid = $row[7];
    		$date = $row[0];
    		$rater = $row[8];
    		//echo "SELECT * FROM rating WHERE restid=$restid AND userid=$userid AND date='$date' and id =$ratingID";
    		if(pg_num_rows(pg_query($dbcnx,"SELECT * FROM rating WHERE restid=$restid AND userid=$userid AND date='$date' AND id =$ratingID "))>0){
    			$ratings.="<!-- Indicates a dangerous or potentially negative action -->
				<button type=\"button\" onClick=\"deleteRating(".$row[9].")\"class=\"btn btn-danger\">Delete</button>";
    		}

    		//Add the plus minous option
    		$ratings.="<a href=\"javascript:void(0);\" onclick=\"changeRep(".$rater.", 1)\" class=\"btn btn-xs btn-default\">+</a>"; 
    		$ratings.="<a href=\"javascript:void(0);\" onclick=\"changeRep(".$rater.", 0)\" class=\"btn btn-xs btn-default\">-</a>";
    		$ratings.="</li>";
	}
}else{
	echo "Query failed";
}
$ratings .="</div>";


$deleteBox;


    if(pg_num_rows(pg_query($dbcnx,"SELECT * FROM location WHERE id=$id AND userid=$userid"))>0){
    	if($row = pg_query($dbcnx, "SELECT * FROM location WHERE id=$id AND userid=$userid")){
    		$deleteBox.="<!-- Indicates a dangerous or potentially negative action -->
      <button type=\"button\" onClick=\"deleteLocation(".pg_fetch_result($row, 0, "id").")\"class=\"btn btn-danger\">Delete Location</button>";
    	}
      
    }


//echo $generalString;
//echo $timeString;
//echo $menu;
//echo $deleteBox;
//$testArr = array('general' =>$menu);
//echo json_encode($testArr);
$arr = array('times' => $timeString, 'general' =>$generalString, 'menu' => $menu, 'ratings' => $ratings, 'deleteBox' => $deleteBox);
echo json_encode($arr);
//echo htmlspecialchars($json);
//echo html_entity_decode($jsontxt);
pg_close($dbcnx);


?>
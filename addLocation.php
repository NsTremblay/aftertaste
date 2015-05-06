<?php
	require_once("includes/header.php");
	//this page will hadle the request to add a form

	function getCoordinates($address){
		$address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern
		$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
		$response = file_get_contents($url);
		$json = json_decode($response,TRUE); //generate array object from the response from the web
		return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
	}

	
	$userid = $_GET['userid'];
	$oMon = $_POST['oMon'];
	$cMon = $_POST['cMon'];
	$oTue = $_POST['oTue'];
	$cTue = $_POST['cTue'];
	$oWed = $_POST['oWed'];
	$cWed = $_POST['cWed'];
	$oThu = $_POST['oThu'];
	$cThu = $_POST['cThu'];
	$oFri = $_POST['oFri'];
	$cFri = $_POST['cFri'];
	$oSat = $_POST['oSat'];
	$cSat = $_POST['cSat'];
	$oSun = $_POST['oSun'];
	$cSun = $_POST['cSun'];

	$closedMon = $_POST['closedMon'];
	$closedTue = $_POST['closedTue'];
	$closedWed = $_POST['closedWed'];
	$closedThu = $_POST['closedThu'];
	$closedFri = $_POST['closedFri'];
	$closedSat = $_POST['closedSat'];
	$closedSun = $_POST['closedSun'];	

	$phone = $_POST['phone'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$manager = $_POST['manager'];
	$odate = $_POST['odate'];
	$type = $_POST['type'];
	$url = $_POST['url'];

	$coordinates = getCoordinates($address);
//echo $name;
if($name){
	//there has been a query, lets put it in the database
	$userid = $_POST['userid'];
	$timeString;
	$locationInfo;
	$restID;

	$address = pg_escape_string($address);
	$name = pg_escape_string($name);

	$query = pg_query($dbcnx, "SELECT id FROM restaurant WHERE name='$name'");

	if(pg_num_rows($query)==0){
		//add restaurant and location
		if(pg_query($dbcnx, "INSERT INTO restaurant (name, url, type) VALUES ('$name','$url','$type')")){
			if($restidd = pg_query($dbcnx,"SELECT id FROM restaurant WHERE name='$name'")){

				$restID = pg_fetch_result($restidd, 0, "id");
				echo $restID;
				//echo "INSERT INTO location (fodate, mname, pnumber, saddress, restid, coordinates, userid) VALUES ('$odate','$name','$phone', '$address' ,$row, '$coordinates', $userid)";
				if(pg_query($dbcnx,"INSERT INTO location (fodate, pnumber, saddress, restid, coordinates, userid, manager) VALUES ('$odate','$phone', '$address' ,$restID, '$coordinates', $userid,'$manager')")){
					echo "This new restaurant was successfully added";
				}else{
					echo "Could not add location";
				}

			}
		}else{
			echo "failed to add restaurant";
		}
	}else{
		if($restidd = pg_query($dbcnx,"SELECT id FROM restaurant WHERE name='$name'")){
			$restID = pg_fetch_result($restidd, 0, "id");
			//echo $fodate;

			$address = pg_escape_string($address);
			$name = pg_escape_string($name);
			//echo "INSERT INTO location (fodate, mname, pnumber, saddress, restid, coordinates) VALUES ('$odate','$name','$phone', '$address',$row, '$coordinates')";
			if(pg_query($dbcnx,"INSERT INTO location (fodate, pnumber, saddress, restid, coordinates, userid, manager) VALUES ('$odate','$phone', '$address' ,$restID, '$coordinates', $userid, '$manager')")){
				echo "The restaurant was successfully added";
					if($restNumber = pg_query($dbcnx, "SELECT id from restaurant WHERE name='$name'")){
						$restid = pg_fetch_result($restNumber, 0, "id");
					}	
			}else{
				echo "failed to add";
			}
		}

	}

	//get the location's id
	if($restidd = pg_query($dbcnx,"SELECT MAX(id) as maxid FROM location")){
		$id = pg_fetch_result($restidd, 0, "maxid");
	}
	//echo $id;
	$timeString;
	//echo $closedMon;
	if(!$closedMon){
		$timeString.="INSERT INTO times (open, close, restid,time) VALUES ('$oMon','$cMon',$id,'mon');";
	}
	if(!$closedTue){
		$timeString.="INSERT INTO times (open, close, restid,time) VALUES ('$oTue','$cTue',$id,'tue');";
	}
	if(!$closedWed){
		$timeString.="INSERT INTO times (open, close, restid,time) VALUES ('$oWed','$cWed',$id,'wed');";
	}
	if(!$closedThu){
		$timeString.="INSERT INTO times (open, close, restid,time) VALUES ('$oThu','$cThu',$id,'thu');";
	}
	if(!$closedFri){
		$timeString.="INSERT INTO times (open, close, restid,time) VALUES ('$oFri','$cFri',$id,'fri');";
	}
	if(!$closedSat){
		$timeString.="INSERT INTO times (open, close, restid,time) VALUES ('$oSat','$cSat',$id,'sat');";
	}
	if(!$closedSun){
		$timeString.="INSERT INTO times (open, close, restid,time) VALUES ('$oSun','$cSun',$id,'sun');";
	}
	if(pg_query($dbcnx,$timeString)){
		echo "The restaurant was successfully added, please go back to the restaurant page";

	}else{
		echo "not add times";
	}
	
}


?>


<head>
	<script type="text/javascript" src="clockpicker-gh-pages 2/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="clockpicker-gh-pages 2/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="clockpicker-gh-pages 2/dist/bootstrap-clockpicker.min.js"></script>
	<script src="bootstrap/js/bootstrap-datepicker.js"></script>

    <link rel="stylesheet" type="text/css" href="clockpicker-gh-pages 2/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="clockpicker-gh-pages 2/dist/bootstrap-clockpicker.min.css">
	<link rel="stylesheet" type="text/css" href="clockpicker-gh-pages 2/assets/css/github.min.css">
	<link href="css/datepicker.css" rel="stylesheet">
</head>

<body>




<div class="container">

    <form name="addrater" action="addLocation.php" onsubmit="return validateAddRaterForm()" method="post">
        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
        <div class="input-group">
            <span class="input-group-addon">Name</span>
            <input id="name" name="name" value="<?php echo $_GET['name']; ?>" type="text" id="" class="form-control" >
        </div>
      
        <div class="input-group">
            <span class="input-group-addon">Phone Number</span>
            <input id="phone" name="phone" value="" type="tel" id="" class="form-control" placeholder="">
        </div>

        <div class="input-group">
            <span class="input-group-addon">Address</span>
        	<input id="address" name="address" value="" type="text" id="" class="form-control" placeholder="">
        </div>

        <input style="display:none;" id="coordinates">

		<h3>Hours</h3>

		<div class="input-group">
            <span class="input-group-addon" style="float:left;width:100pt;height:24pt;">Monday :</span>
			
            <span style="float:left;"> &nbsp;&nbsp;&nbsp;Open &nbsp;</span>
            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left">
		    		   
		    	<input type="text" id="oMon" name="oMon" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
		    
			</div>
			<span style="float:left;"> &nbsp;&nbsp;&nbsp;Close &nbsp;</span>
			<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left">
				<input type="text" name="cMon" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
			</div>
			<span style="float:left;"> &nbsp;&nbsp;&nbsp;Closed &nbsp;</span>

			<input type="checkbox" style="position:relative;float:left;" name="closedMon" value="off">

        </div>



        		<div class="input-group">
            <span class="input-group-addon"style="float:left;width:100pt;height:24pt;">Tuesday :</span>
            
            <span style="float:left;"> &nbsp;&nbsp;&nbsp;Open &nbsp;</span>
            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
		    		    
		    	<input type="text" name="oTue" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
		    
			</div>

			<span style="float:left;"> &nbsp;&nbsp;&nbsp;Close &nbsp;</span>

			<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
				<input type="text" name="cTue" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
			</div>
			<span style="float:left;"> &nbsp;&nbsp;&nbsp;Closed &nbsp;</span>

			<input type="checkbox" style="position:relative;float:left;" name="closedTue" value="off">
        </div>
        		<div class="input-group">
            <span class="input-group-addon"style="float:left;width:100pt;height:24pt;">Wednesday :</span>
            <span style="float:left;"> &nbsp;&nbsp;&nbsp;Open &nbsp;</span>
            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
		    		    
		    	<input type="text" name="oWed" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
		    
			</div>
						<span style="float:left;"> &nbsp;&nbsp;&nbsp;Close &nbsp;</span>

			<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
				<input type="text" name="cWed" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
			</div>

			<span style="float:left;"> &nbsp;&nbsp;&nbsp;Closed &nbsp;</span>

			<input type="checkbox" style="position:relative;float:left;" name="closedWed" value="off">
        </div>
        		<div class="input-group">
            <span class="input-group-addon"style="float:left;width:100pt;height:24pt;">Thursday :</span>
            <span style="float:left;"> &nbsp;&nbsp;&nbsp;Open &nbsp;</span>

            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
		    		    
		    	<input type="text" name="oThu" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
		    
			</div>
						<span style="float:left;"> &nbsp;&nbsp;&nbsp;Close &nbsp;</span>

			<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
				<input type="text" name="cThu" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
			</div>

			<span style="float:left;"> &nbsp;&nbsp;&nbsp;Closed &nbsp;</span>

			<input type="checkbox" style="position:relative;float:left;" name="closedThu" value="off">
        </div>
        <div class="input-group">
            <span class="input-group-addon"style="float:left;width:100pt;height:24pt;">Friday :</span>
            <span style="float:left;"> &nbsp;&nbsp;&nbsp;Open &nbsp;</span>
            
            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
		    		    
		    	<input type="text" name="oFri" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
		    
			</div>
						<span style="float:left;"> &nbsp;&nbsp;&nbsp;Close &nbsp;</span>

			<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
				<input type="text" name="cFri" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
			</div>
			<span style="float:left;"> &nbsp;&nbsp;&nbsp;Closed &nbsp;</span>

			<input type="checkbox" style="position:relative;float:left;" name="closedFri" value="off">
        </div>

        <div class="input-group">
            <span class="input-group-addon"style="float:left;width:100pt;height:24pt;">Saturday :</span>
            <span style="float:left;"> &nbsp;&nbsp;&nbsp;Open &nbsp;</span>
            
            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
		    		    
		    	<input type="text" name="oSat" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
		    
			</div>
						<span style="float:left;"> &nbsp;&nbsp;&nbsp;Close &nbsp;</span>

			<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
				<input type="text" name="cSat" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
			</div>
			<span style="float:left;"> &nbsp;&nbsp;&nbsp;Closed &nbsp;</span>

			<input type="checkbox" style="position:relative;float:left;" name="closedSat" value="off">
        </div>

        <div class="input-group">
            <span class="input-group-addon"style="float:left;width:100pt;height:24pt;">Sunday :</span>
             <span style="float:left;"> &nbsp;&nbsp;&nbsp;Open &nbsp;</span>
           
            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
		    		    
		    	<input type="text" name="oSun" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
		    
			</div>
						<span style="float:left;"> &nbsp;&nbsp;&nbsp;Close &nbsp;</span>

			<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true" style="width:100pt; position:relative; float:left;">
				<input type="text" name="cSun" class="form-control" value="00:00">
		    	<span class="input-group-addon">
		        <span class="glyphicon glyphicon-time"></span>
		    	</span>
			</div>
			<span style="float:left;"> &nbsp;&nbsp;&nbsp;Closed &nbsp;</span>

			<input type="checkbox" style="position:relative;float:left;" name="closedSun" value="off">
        </div>

		
<br>
<br>
  		<div class="input-group">
            <span class="input-group-addon">Manager</span>
            <input id="manager" name="manager" value=""  class="form-control" placeholder="">
          </div>
            
          <div class="input-group">
            <span class="input-group-addon">Opening date</span>
			<input type="text" name="odate" class="datepicker" value="02/16/2010" data-date-format="mm/dd/yy" id="dp2">          
			</div>

		<div class="input-group">
            <span class="input-group-addon">Type</span>
            <input id="type" name="type" value="" class="form-control" placeholder="">
          </div>
        <div class="input-group">
            <span class="input-group-addon">URL</span>
            <input id="url" name="url" value="" class="form-control" placeholder="">
        </div>
            
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Ok</button>
      </form>
    
</div>





<script type="text/javascript">

$.fn.datepicker.defaults.format = "mm/dd/yyyy";
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
})


$('.clockpicker').clockpicker();


</script>

</body>
</html>
<?php

require_once("includes/header.php");

$restID = $_GET['restNo'];
$restID = pg_escape_string($restID);

$query = "SELECT * FROM restaurant WHERE id=$restID";
$result = pg_query($dbcnx, $query);

if($result){
	while($row = pg_fetch_row($result)){
		$restName = $row[0];
	}
}else{
	echo "Query failed";
}

//get the coordinates


?>

<head>
 <style>
      #map-canvas {
        width: 500px;
        height: 200px;
        background-color: #CCC;

      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
  		function initialize() {}
  		var map = new google.maps.Map();
	</script>
<script>
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var myLatlng = new google.maps.LatLng(45.421664, -75.699479);
        var mapOptions = {
          center: myLatlng,
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
                var marker = new google.maps.Marker({
      		position: myLatlng,
      		map: map,
      		title: 'Hello World!'
  		});
      	}
      	google.maps.event.addDomListener(window, 'load', initialize);

    </script>
</head>

<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; "><?php echo $restName;?></h2>

<div id="map-canvas"></div>

</div>



</div>


</body>
</html>

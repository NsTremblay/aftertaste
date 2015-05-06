<?php

require_once("includes/header.php");

$restID = $_GET['restNo'];
$restID = pg_escape_string($restID);

$query = "SELECT * FROM restaurant WHERE id=$restID";
$result = pg_query($dbcnx, $query);

$userid= $_GET['userid'];
$location;
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
        width: 49%;
        height: 50%;
        background-color: #CCC;
        position: relative;
        float: left;
      }
      #contentRight{
        width:45%;
        position:relative;
        padding-left: 10pt;
        height:50%;
        float: left;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>

<script>

      var rater = "";
      <?php

        if($id){
          echo "rater = ".$id.";";
        }

        //get the locations
        echo "var locations = [\n";

        $location = pg_query($dbcnx, "SELECT * from location where restID = (SELECT id FROM restaurant WHERE id=$restID)");
        if($location){
          while($locationRow = pg_fetch_row($location)){
            if($locationRow[7]){
              echo "[\"".$locationRow[2]."\",\"".$locationRow[1]."\",".$locationRow[7].",".$locationRow[5]."],\n";
            }
          }
        }
        echo "[0,0,0,0,0]\n];\n";

        echo "var menuItems = [\n";
        $menuItems = pg_query($dbcnx, "SELECT * FROM menuitem WHERE restID IN (SELECT id FROM location WHERE restid=$restID)");
        if($menuItems){
          while($menuItemsRow = pg_fetch_row($menuItems)){
            echo "[".$menuItemsRow[6].",".$menuItemsRow[5].",\"".$menuItemsRow[0]."\"],\n";
          }
        }
        echo "];";
      ?>

      locationID = locations[0][4];
      
      function initialize(){
          // window.alert("now");

          var mapCanvas = document.getElementById('map-canvas');

          //make an array of markers
          var myLatlng = new google.maps.LatLng(locations[0][2],locations[0][3]);
          var mapOptions = {
            center: myLatlng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }
          var map = new google.maps.Map(mapCanvas, mapOptions);

          var infowindow = new google.maps.InfoWindow();
          for (i = 0; i < (locations.length-1); i++) {  
            marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[i][2], locations[i][3]),
              map: map
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                locationID = locations[i][4];
                showTimes(locations[i][4]);
                var content = locations[i][0]+"<br>"+locations[i][1];
                infowindow.setContent(content);
                infowindow.open(map, marker);
              }

            })(marker, i));
          }
          showTimes(locations[i][4]);
      }


      google.maps.event.addDomListener(window, 'load', initialize);
        
      function showTimes(str){
        locationID = str;
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        } else { // code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {

            obj = JSON.parse(xmlhttp.responseText);
            document.getElementById("hoursContent").innerHTML = obj.times;
            document.getElementById("generalInformation").innerHTML = obj.general;
            document.getElementById("menu").innerHTML = obj.menu;
            document.getElementById("deleteBox").innerHTML = obj.deleteBox;
              
            //window.alert(obj.ratings);
            document.getElementById("ratings").innerHTML = obj.ratings;
            
            itemRatingInfo = "";

            for(i = 0; i<menuItems.length; i++){
              if(menuItems[i][0]==locationID){
                itemRatingInfo = itemRatingInfo + "<input name=\"itemList[]\" value=\""+menuItems[i][1]+"\" onclick=\"selectFun()\" type=\"checkbox\"></input>";
                itemRatingInfo = itemRatingInfo + "<select onmouseout=\"selectFun()\" value=\""+menuItems[i][1]+"\" name=\"ratings[]\"><option value=\"1\">1</option>";
                itemRatingInfo = itemRatingInfo + "<option value=\"2\">2</option>";
                itemRatingInfo = itemRatingInfo + "<option value=\"3\">3</option>";
                itemRatingInfo = itemRatingInfo + "<option value=\"4\">4</option>";
                itemRatingInfo = itemRatingInfo + "<option value=\"5\">5</option>";
                itemRatingInfo = itemRatingInfo + "</select>";
                itemRatingInfo = itemRatingInfo + menuItems[i][2]+"<br>";
              }
            }

            document.getElementById("ratingItem").innerHTML = itemRatingInfo;
          }
        }
        //window.alert("locationinfo.php?type="+type+"&id="+str);
        xmlhttp.open("GET","locationinfo.php?id="+str+"&userid="+rater,true);
        xmlhttp.send();
      }
      itemString="";
      function selectFun(){
        //Repopulate the srtring with the configurations
        var numberOfItems = document.getElementsByName("itemList[]").length;
        itemString = "";
        for(b = 0; b<numberOfItems; b++){
          itemString = itemString+document.getElementsByName("ratings[]")[b].value+",";
          itemString = itemString+rater+",";
          itemString = itemString+document.getElementsByName("itemList[]")[b].value+",";
          itemString = itemString+document.getElementsByName("itemList[]")[b].checked+";";
        }
        //alert(itemString);     
      }

      function submitForm() {
        var http = new XMLHttpRequest();
      
        http.open("POST", "addItem.php", true);

        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var params = "type=" + document.getElementById("type").value;
        params = params +"&category="+document.getElementById("category").value;
        params = params +"&description="+document.getElementById("description").value;
        params = params +"&price="+document.getElementById("price").value;
        params = params +"&id="+locationID;
        params = params +"&userid="+rater;
        params = params +"&item="+document.getElementById("item").value;
        http.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      
              //alert(http.responseText);
              showTimes(locationID);
            }
        }
        http.send(params);
      }

      function submitRating() {
        var http = new XMLHttpRequest();
      
        http.open("POST", "addRating.php", true);

        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var params = "priceNo=" + document.getElementById("priceNo").value;
        params = params +"&food="+document.getElementById("food").value;
        params = params +"&mood="+document.getElementById("mood").value;
        params = params +"&staff="+document.getElementById("staff").value;
        params = params +"&comment="+document.getElementById("comment").value;
        params = params +"&id="+locationID;
        params = params +"&itemsRatings="+itemString;
        params = params +"&userid="+rater;
        http.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
              //alert(http.responseText);
              showTimes(locationID);
            }
        }
        http.send(params);
      }



      function deleteItem(itemID) {
        var http = new XMLHttpRequest();
      
        http.open("POST", "delete.php", true);

        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var params = "item="+itemID;
        http.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      
              //alert(http.responseText);
              showTimes(locationID);
            }
        }
        http.send(params);
      }
      function deleteRating(ratingID) {
        var http = new XMLHttpRequest();
      
        http.open("POST", "delete.php", true);

        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var params = "rating="+ratingID;
        http.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      
              //alert(http.responseText);
              showTimes(locationID);
            }
        }
        http.send(params);
      }
      function deleteLocation(locationID) {
        var http = new XMLHttpRequest();
      
        http.open("POST", "delete.php", true);

        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var params = "location="+locationID;
        http.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      
              //alert(http.responseText);
              showTimes(locationID);
            }
        }
        http.send(params);
      }
      function changeRep(rater, plus) {
        var http = new XMLHttpRequest();
      
        http.open("POST", "changeRep.php", true);

        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var params = "rater="+rater;
        params = params+"&plus="+plus;
        http.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      
              //alert(http.responseText);
              showTimes(locationID);
            }
        }
        http.send(params);
      }

    </script>

</head>


<body onload="showTimes(locations[0][4])">




<div class="container">

<h1><?php  echo $restName;  ?></h1>


      <div id="map-canvas"></div>
      <div id="contentRight" style="overflow-y: scroll;">
        
        <!-- iformation on the restaurant foes here-->

        <div class="panel panel-default">
          <div class="panel-heading"><h3 class="panel-title">Hours</h3></div>
          <div id ="hoursContent" class="panel-body">
            No times to show
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">General</h3>
          </div>
          <div id="generalInformation" class="panel-body">
            No general information available
          </div>
        </div>

      </div>
<div role="tabpanel"  >

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist" >
    <li role="presentation"><a href="#menuToggle" aria-controls="menuToggle" role="tab" data-toggle="tab">Menu</a></li>
    <li role="presentation"><a href="#ratingsToggle" aria-controls="ratingsToggle" role="tab" data-toggle="tab">Ratings</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
    <div role="tabpanel" class="tab-pane" id="menuToggle">
    <div role="tabpanel" class="tab-pane" id="menu"><br></div>

    
      
      <?php
        if($id){
          echo "<li class=\"list-group-item\">";
          echo "<input name=\"item\" id=\"item\" placeholder=\"Item Name\"></input>
      <select id=\"category\" name=\"category\">
        <option value=\"starter\">Starter</option>
        <option value=\"main\">Main</option>
        <option value=\"desert\">Desert</option>
      </select>
      <select id=\"type\" name=\"type\">
        <option value=\"food\">Food</option>
        <option value=\"beverage\">Beverage</option>
      </select>
      <input name=\"description\" id=\"description\" placeholder=\"Add a Description\"></input>
      <input name=\"price\" id=\"price\" placeholder=\"0.00\"></input>
        <button onClick=\"submitForm()\" class=\"btn btn-primary\">Add a menu item</button> 
      
      <input id=\"rater\" name =\"rater\" value=\"<?php echo $userid;?>\" type=\"hidden\">

      </li>";
        }else{
          echo "Please sign in to add a menu item";
        }

      ?>

    </div>


    <div role="tabpanel" class="tab-pane" id="ratingsToggle">
    <div role="tabpanel" class="tab-pane" id="ratings"><br></div>
          <?php
        if($id){
          echo "<li class=\"list-group-item\">";
          echo "
          price :
          <select id=\"priceNo\" name=\"priceNo\">
            <option value=\"1\">1</option>
            <option value=\"2\">2</option>
            <option value=\"3\">3</option>
            <option value=\"4\">4</option>
            <option value=\"5\">5</option>
          </select>
           mood :
          <select id=\"mood\" name=\"mood\">
            <option value=\"1\">1</option>
            <option value=\"2\">2</option>
            <option value=\"3\">3</option>
            <option value=\"4\">4</option>
            <option value=\"5\">5</option>
          </select>
           food :
          <select id=\"food\" name=\"food\">
            <option value=\"1\">1</option>
            <option value=\"2\">2</option>
            <option value=\"3\">3</option>
            <option value=\"4\">4</option>
            <option value=\"5\">5</option>
          </select>
           staff :
          <select id=\"staff\" name=\"staff\">
            <option value=\"1\">1</option>
            <option value=\"2\">2</option>
            <option value=\"3\">3</option>
            <option value=\"4\">4</option>
            <option value=\"5\">5</option>
          </select>
          <input name=\"comment\" id=\"comment\" placeholder=\"Add a Comment\"></input>
            <button onClick=\"submitRating()\" class=\"btn btn-primary\">Add rating</button>";
          
          echo "<div id=\"ratingItem\"></div>";
          echo "</li>";

        }else{
          echo "Please sign in to add a menu item";
        }
      ?>
    </div>
  </div>

</div>
<br><br>

<?php
if($id){
  echo "<FORM METHOD=\"GET\" ACTION=\"addLocation.php\">
    <button type=\"submit\" class=\"btn btn-primary\">Add a restaurant</button> 
    <input name =\"name\"value=\"$restName\" type=\"hidden\">
    <input name =\"userid\"value=\"$userid\" type=\"hidden\">
  </FORM>";
}
?>
  <div id="deleteBox"></div>

</div>


</body>
</html>

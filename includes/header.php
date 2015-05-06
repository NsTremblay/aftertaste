<?php


?>

<html>
<head>
<meta charset="iso-8859-1" />
<title>Aftertaste</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="../js/jquery.stickyheader.js"></script>


<div class="navbar navbar-default" style = "min-height: 52px">
<div class="container">
<div class="navbar-header">
<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand">&nbsp;&nbsp;AFTERTASTE&nbsp;&nbsp;&nbsp;</a>
</div>
<center>
<div class="navbar-collapse collapse" id="navbar-main">
<ul class="nav navbar-nav">
<li><a href="./index.php?userid=<?php echo $id;?>"><span style="margin-right: 5px !important;" class="glyphicon glyphicon-home"></span><span>Home</span></a></li>
<li><a href="./atoz.php?userid=<?php echo $id;?>"><span style="margin-right: 5px !important;" class="glyphicon glyphicon-sort-by-alphabet"></span><span>Restaurants</span></a></li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span style="margin-right: 5px !important;" class="glyphicon glyphicon-sort-by-attributes"></span><span>Filtered</span><span class="caret"></span></a>

    <ul class="dropdown-menu" role="menu">
        <li class="dropdown-header"><span class="glyphicon-divider"></span><span><h5>Restaurants and Menus</h5></span></li>
          <li><a href="./managers.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>Managers</span></a></li>
          <li><a href="./mostExpensiveMenuItems.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>Most Expensive Items </span></a></li>
          <li><a href="./averageMealPrice.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>Average Meal Price</span></a></li>
          <li class="divider"></li>  
          <li class="dropdown-header"><span class="glyphicon-divider"></span><span><h5>Ratings of Restaurants</h5></span></li>
          <li><a href="./inactive.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>Unrated in January 2015</span></a></li>
          <li><a href="./lowStaffRatings.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>Lower Staff Ratings Than John</span></a></li>
          <li><a href="./topFoodRatings.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>Top Burger Restaurant Rating</span></a></li>
          <li><a href="./popularFoodTypes.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>Food Types Less Popular Than Burgers</span></a></li>
          <li class="divider"></li>  
          <li class="dropdown-header"><span class="glyphicon-divider"></span><span><h5>Raters And Their Ratings</h5></span></li>
          <li><a href="./easyRaters.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>Easiest Food/Mood Raters</span></a></li>
          <li><a href="./frequentRaters.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>The Works's Most Frequent Raters</span></a></li>
          <li><a href="./easierThanJohn.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>No Ratings Higher Than John's highest</span></a></li>
          <li><a href="./diverseRaters.php?userid=<?php echo $id;?>"><span class="glyphicon"></span><span>Indecisive Raters</span></a></li>
    </ul>  

</li>




</ul>

<?php



?>
    

</div>
</center>
</div>
</div>

</head>
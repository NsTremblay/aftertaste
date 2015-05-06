
<?php include("includes/header.php"); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="js/jquery.stickyheader.js"></script>
<link rel="stylesheet" type="text/css" href="css/component.css" />

<body>

<div class="container">
<div class="jumbotron">

<h2 style = "margin-top: -20px; ">Easiest Food/Mood Raters</h2>
<?php
     $topraters = pg_query($dbcnx, "SELECT r.userid, (AVG(ra.food) + AVG(ra.mood))/2 as avg FROM rater r, rating ra WHERE ra.userid = r.userid GROUP BY r.userid ORDER BY avg DESC LIMIT 5;");
     while($row = pg_fetch_row($topraters)){
    
     $raterInfo = pg_query($dbcnx, "SELECT name, email, jdate, reputation FROM rater WHERE userid = '".$row[0]."'");
     while($row2 = pg_fetch_row($raterInfo)){      
    ?>
<div class="list-group">
  <li class="list-group-item">
    <h4 class="list-group-item-heading">Rater Information</h4>
    <p class="list-group-item-text"><?php echo $row2[0];?><br><?php echo $row2[1];?><br>Joined On <?php echo $row2[2];?><br>Reputation - <?php echo $row2[3];?><br> Average rating - <?php echo substr($row[1],0,3);?></p>
  </li>
  <li class="list-group-item">
    <h4 class="list-group-item-heading">Ratings</h4>
    <p class="list-group-item-text">
            <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Restaurant</th>
                </tr>
            </thead>
            <tbody> 
                <?php
     $ratings = pg_query($dbcnx, "SELECT ra.date, r.name FROM rater rat, location l, restaurant r, rating ra WHERE rat.userid = ra.userid AND ra.restid = l.id AND l.restid = r.id AND ra.userid = '".$row[0]."'");
     while($row3 = pg_fetch_row($ratings)){ ?>
                <tr>
                    <td><?php echo $row3[0];?></td>
                    <td><?php echo $row3[1];?></td>
                </tr>
     <?php } ?>
            </tbody>   
        </table>
    </p>
  </li>
</div>

     <?php } }?>


</div>



</div>


</body>
</html>

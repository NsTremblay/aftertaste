
<?php include("includes/header.php"); ?>

<body>
<?php
        $topburgerplace = "SELECT avg(ra.food) as avg, l.id FROM rating ra, location l, restaurant r WHERE ra.restid=l.id AND l.restid = r.id AND r.type = 'Burger' GROUP BY l.id ORDER BY avg DESC LIMIT 1;";
        $tbp = pg_query($dbcnx, $topburgerplace);
        while($top = pg_fetch_row($tbp)){ $topid = $top[1];}
?> 
<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">Top Burger Restaurant Rating</h2>
<div class="list-group">
  <li class="list-group-item">
      <?php
       $info = pg_query($dbcnx, "SELECT r.name, l.pnumber, r.url FROM location l, restaurant r WHERE l.restid = r.id AND l.id = '".$topid."'");
       while($row = pg_fetch_row($info)){?>
    <h4 class="list-group-item-heading">Restaurant Information</h4>
       <p class="list-group-item-text"><?php echo $row[0];?><br><?php echo $row[1];?><br><?php echo $row[2];}?></p>
       <?php
                $info = pg_query($dbcnx, "SELECT t.time, t.open, t.close FROM location l, time t WHERE t.restid = l.id AND l.id = '".$topid."'");
                while($row = pg_fetch_row($info)){?>
                <p class="list-group-item-text"><?php echo $row[0];?>: <?php echo $row[1];?> - <?php echo $row[2];?><br><?php }?></p>
       
  </li>
  <li class="list-group-item">
    <h4 class="list-group-item-heading">Ratings</h4>
    <p class="list-group-item-text">
        
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Rating</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $info = pg_query($dbcnx, "SELECT ra.date, ra.food, r.name FROM location l, rater r, rating ra WHERE ra.restid = l.id AND l.id = '".$topid."'");
                while($row = pg_fetch_row($info)){?>
                <tr>
                    <td><?php echo $row[0];?></td>
                    <td><?php echo $row[1];?></td>
                    <td><?php echo $row[2];?></td>
                </tr>
                <?php } ?>
            </tbody>   
        </table>
    </p>
  </li>
</div>
</div>



</div>


</body>
</html>

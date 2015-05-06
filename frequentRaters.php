
<?php include("includes/header.php"); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="js/jquery.stickyheader.js"></script>
<link rel="stylesheet" type="text/css" href="css/component.css" />

<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">The Works's Most Frequent Raters</h2>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    
 <?php
     $freqraters = pg_query($dbcnx, "SELECT ra.userid, rat.name, rat.reputation, count(ra.id) as ct FROM rater rat, rating ra, restaurant r, location l WHERE rat.userid = ra.userid AND ra.restid = l.id AND l.restid = r.id AND r.name = 'The Works' GROUP BY ra.userid, rat.reputation, rat.name ORDER BY ct DESC LIMIT 3;");
     while($row = pg_fetch_row($freqraters)){ ?>
  <div class="panel panel-default">  
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <?php echo $row[1];?> - Reputation: <?php echo $row[2];?> - Rated The Works: <?php echo $row[3];?>&nbsp;times
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <table>
            <thead>
                <tr>
                    <th>Comment</th>
                    <th>Menu Item</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fqs = pg_query($dbcnx, "SELECT ra.comments, ra.id FROM rater rat, rating ra, restaurant r, location l WHERE rat.userid = ra.userid AND ra.restid = l.id AND l.restid = r.id AND r.name = 'The Works'");
                while($row2 = pg_fetch_row($fqs)){ ?>
                <tr>
                <td><?php echo $row2[0];?></td>
                
                <?php }
                
                 $fqs = pg_query($dbcnx, "SELECT m.price, m.name FROM menuitem m, rater rat, rating ra, restaurant r, location l WHERE rat.userid = ra.userid AND ra.restid = l.id AND l.restid = r.id AND ra.id = '".$row2[1]."' AND r.name = 'The Works'");
                 while($row2 = pg_fetch_row($fqs)){ ?>
                
                    <td>Tacos</td>
                    <td>Tasty as fuck</td>
                 <?php }?>
                </tr>
                </tr>
            </tbody>   
        </table>
      </div>
    </div>
  </div>
    
        <?php }?>
    
</div>
</div>



</div>


</body>
</html>

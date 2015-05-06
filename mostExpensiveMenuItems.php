
<?php include("includes/header.php"); 
$id = $_GET['id'];
$id = pg_escape_string($id);
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="js/jquery.stickyheader.js"></script>
<link rel="stylesheet" type="text/css" href="css/component.css" />

<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">Most Expensive Menu Items</h2>
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <?php 
    $query = pg_query($dbcnx, "SELECT name FROM restaurant where id = ".$id."");
    while($row = pg_fetch_row($query)){$name = $row[0];}
    if($name != ""){echo $name;}else{echo "Restaurant";}?> <span class="caret"></span>
  </button><br>
  <ul class="dropdown-menu" role="menu">
    <?php
        $query = pg_query($dbcnx, "SELECT * FROM restaurant");

        if (!$query) {
          echo "An error occurred.\n";
          exit;
        }

        while($row = pg_fetch_row($query)){
            echo "<tr>"; ?>
            <li><a href="mostExpensiveMenuItems.php?id=<?php echo $row[3]?>"><?php echo $row[0]?></a></li>
            <?php 
            echo "</tr>";
        }

    ?>
  </ul>
</div>

 <?php
        
        $query = "SELECT l.id, l.saddress FROM restaurant r, location l WHERE l.restid = r.id AND l.restid = "."'".$id."'"."";
        //echo $query;
        $locations = pg_query($dbcnx, $query);
        $index = 1;
while($row2 = pg_fetch_row($locations)){ ?>

<div class="list-group">          
                  <?php
        $query = "SELECT m.name, m.price, l.manager FROM menuitem m, location l WHERE l.id = m.restid AND m.restid = "."'".$row2[0]."'"." ORDER BY m.price DESC limit 1";
        //echo $query;
        $result = pg_query($dbcnx, $query);
   
    while ($row = pg_fetch_row($result)) { ?>
              <h3><?php echo $row2[1];?></h3>  
  <li class="list-group-item">
    <h4 class="list-group-item-heading">Menu Item</h4>
    <p class="list-group-item-text">
        <?php
    if($row[0]!=""){echo $row[0];?><br><?php echo $row[1];?>$</p>
        
  </li>
  <li class="list-group-item">
    <h4 class="list-group-item-heading">Restaurant Information</h4>
    <p class="list-group-item-text">Manager: <?php echo $row[2];}?><br>
        <?php
        $query = "SELECT t.time, t.open, t.close FROM location l, times t WHERE l.id = t.restid AND l.id = "."'".$row2[0]."'";
        //echo $query;
        $result = pg_query($dbcnx, $query);
    while ($row = pg_fetch_row($result)) {
    ?> <?php echo $row[0];?> : <?php echo $row[1];?> - <?php echo $row[2];?><br><?php }?>
        
        </p>
  </li>
  <?php
    }}
        ?>
</div>

</div>
</div>


</body>
</html>

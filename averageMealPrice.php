
<?php include("includes/header.php"); 
$type = $_GET['type'];
$type = pg_escape_string($type);
?>


<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">Average Meal Price</h2>
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <?php if($type != ""){echo $type;}else{echo "Food Type";}?> <span class="caret"></span>
  </button><br>
  <?php
    $r = pg_query($dbcnx, "SELECT DISTINCT type FROM restaurant");
  if (!$r) {
    echo "An error occurred.\n";
    exit;
  }
 ?><ul class="dropdown-menu" role="menu">
  <?php 
    while ($ro = pg_fetch_row($r)) { 
    $typetruncated = preg_replace('/\s+/', '', $ro[0]);
    ?>
    <li><a href="averageMealPrice.php?type=<?php echo $typetruncated ?>"><?php echo $ro[0]?></a></li>
    <?php
  }
  ?>
  </ul>
  
  
</div>


<?php

    $query = "SELECT DISTINCT m.category FROM restaurant r, location l, menuitem m WHERE replace(r.type, ' ','') = "."'".$type."'"." AND r.id = l.restid AND l.id = m.restid;";
    //echo $query;
    $result1 = pg_query($dbcnx, $query);
    
 ?>
        

<div class="list-group">
    <?php
      while($row = pg_fetch_row($result1)){?>
  <li class="list-group-item">
    <h4 class="list-group-item-heading"><?php echo $row[0];?></h4>
    <p class="list-group-item-text">
        
        <?php
        $query2 = "SELECT AVG(m.price) FROM restaurant r, location l, menuitem m WHERE replace(r.type, ' ','') = "."'".$type."'"." AND r.id = l.restid AND l.id = m.restid AND m.category = "."'".$row[0]."'".";";
        //echo $query2;
        $result2 = pg_query($dbcnx, $query2);
        while($row2 = pg_fetch_row($result2)){echo money_format('$%i', $row2[0]);}?>
        
    </p>    
  </li>
  <?php }?>
</div>

</div>


</body>
</html>

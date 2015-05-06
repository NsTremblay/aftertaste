
<?php include("includes/header.php"); 

$type = $_GET['type'];
$type = pg_escape_string($type);

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="js/jquery.stickyheader.js"></script>
<link rel="stylesheet" type="text/css" href="css/component.css" />

<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">Managers</h2>
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <?php if($type != ""){echo $type;}else{echo "Food Type";}?> <span class="caret"></span>
  </button><br>
  <?php
    $result = pg_query($dbcnx, "SELECT DISTINCT type FROM restaurant");
  if (!$result) {
    echo "An error occurred.\n";
    exit;
  }
 ?><ul class="dropdown-menu" role="menu">
  <?php 
    while ($row = pg_fetch_row($result)) { 
    $typetruncated = preg_replace('/\s+/', '', $row[0]);
    ?>
    <li><a href="managers.php?type=<?php echo $typetruncated ?>"><?php echo $row[0]?></a></li>
    <?php
  }
  ?>
  </ul>
  
  
</div>

<?php

    $query = "SELECT r.name, l.manager, l.fodate FROM restaurant r, location l WHERE replace(r.type, ' ','') = "."'".$type."'"." AND r.id = l.restid;";
    $result2 = pg_query($dbcnx, $query);
    if (!$result2) {
    echo "An error occurred.\n";
    exit;
  }
 ?>


<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Manager</th>
            <th>Opened Since</th>
            
        </tr>
    </thead>
    <tbody>

  <?php 
    while ($row2 = pg_fetch_row($result2)) { ?>
        <tr>
            <td><?php echo $row2[0] ?></td>
            <td><?php echo $row2[1] ?></td>
            <td><?php echo $row2[2] ?></td>
        </tr>
    <?php
  }
  ?>

    </tbody>   
</table>
</div>



</div>


</body>
</html>

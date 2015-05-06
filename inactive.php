
<?php include("includes/header.php"); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="js/jquery.stickyheader.js"></script>
<link rel="stylesheet" type="text/css" href="css/component.css" />

<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">Unrated in January 2015</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Food Type</th>
            <th>Phone Number</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT l.id FROM Location l where l.id NOT IN (SELECT l.id FROM location l, rating ra WHERE l.id = ra.restid AND ra.date >= '2015-01-01');";
        //echo $query;
        //echo $query;
        $locations = pg_query($dbcnx, $query);
        $index = 1;
        while($row2 = pg_fetch_row($locations)){ 
            
        $query2 = "SELECT l.id, r.name, l.saddress, r.type, l.pnumber FROM Location l, restaurant r WHERE l.restid = r.id AND l.id ='".$row2[0]."';";    
        //echo $query2;
        $results = pg_query($dbcnx, $query2);
        while($row = pg_fetch_row($results)){
        ?>
        <tr>
            <td><?php echo $row[1];?></td>
            <td><?php echo $row[2];?></td>
            <td><?php echo $row[3];?></td>
            <td><?php echo $row[4];?></td>
        </tr>
        
        <?php } }?>
      
        
        
    </tbody>   
</table>
</div>



</div>


</body>
</html>

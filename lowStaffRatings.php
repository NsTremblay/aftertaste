
<?php include("includes/header.php"); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="js/jquery.stickyheader.js"></script>
<link rel="stylesheet" type="text/css" href="css/component.css" />

<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">Lower Staff Ratings Than John</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Opened Since</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        $minquery = "SELECT min(ra.staff) FROM rating ra WHERE ra.userid = '4';";
        $minr = pg_query($dbcnx, $minquery);
        while($min = pg_fetch_row($minr)){ 
        $query = "SELECT DISTINCT r.name, l.saddress,l.fodate FROM restaurant r, location l, rating ra WHERE r.id = l.restid AND ra.restid = l.id AND ra.staff < '".$min[0]."'";   
        //echo $query;
        //echo $query;
        $locations = pg_query($dbcnx, $query);
        while($row = pg_fetch_row($locations)){ 
        ?>
        
        <tr>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td><?php echo $row[2];?></td>
        </tr>
        <?php }}?>
    </tbody>   
</table>
</div>

</div>

</body>
</html>

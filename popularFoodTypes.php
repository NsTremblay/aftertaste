
<?php include("includes/header.php"); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="js/jquery.stickyheader.js"></script>
<link rel="stylesheet" type="text/css" href="css/component.css" />

<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">Food Types Less Popular Than Burgers</h2>
<table>
    <thead>
        <tr>
            <th>Food Type</th>
            <th>Number of Ratings</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        $burgerVoteCount = "SELECT count(ra.id) FROM rating ra, restaurant r, location l WHERE ra.restid = l.id AND r.id = l.restid  AND r.type = 'Burger'";
        $bvc = pg_query($dbcnx, $burgerVoteCount);
        while($count = pg_fetch_row($bvc)){ $burgvotecount = $count[0];}
?> 
        
    <?php
        $alltypes = pg_query($dbcnx, "SELECT DISTINCT type FROM restaurant");
        while($alltype = pg_fetch_row($alltypes)){
        
        $candidate = pg_query($dbcnx, "SELECT count(ra.id) FROM rating ra, restaurant r, location l WHERE ra.restid = l.id AND r.id = l.restid  AND r.type = '".$alltype[0]."'");
        while($row = pg_fetch_row($candidate)){
        
            if($burgvotecount>$row[0]){ ?>
        <tr>  
            <td><?php echo $alltype[0];?></td>
            <td><?php echo $row[0];?></td>
        </tr>
        <?php } } }?>
    </tbody>   
</table>
</div>



</div>


</body>
</html>

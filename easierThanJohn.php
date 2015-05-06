
<?php include("includes/header.php"); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="js/jquery.stickyheader.js"></script>
<link rel="stylesheet" type="text/css" href="css/component.css" />

<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">No Ratings Higher Than John's Highest</h2>
<table>
    <thead>
        <tr>
            <th>Rater</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $johnhighest = pg_query($dbcnx, "SELECT r.userid, max(ra.food + ra.mood + ra.price + ra.staff)/4 as max FROM rater r, rating ra WHERE r.name = 'John' AND ra.userid = r.userid GROUP BY r.userid ORDER BY max DESC LIMIT 1;");
        while($row = pg_fetch_row($johnhighest)){ 
            
        $candidate = pg_query($dbcnx, "SELECT DISTINCT r.name, r.email FROM rater r, rating ra WHERE ra.userid = r.userid AND ra.food + ra.mood + ra.price + ra.staff/4 < '".$row[1]."'");
        while($row2 = pg_fetch_row($candidate)){
       
?>  
        <tr>
            <td><?php echo $row2[0];?></td>
            <td><?php echo $row2[1];?></td>
        </tr>
        
        <?php }} ?>
    </tbody>   
</table>
</div>



</div>


</body>
</html>

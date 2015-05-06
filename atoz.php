
<?php include("includes/header.php"); 
$userid = $_GET['userid'];
?>



<body>

<div class="container">
<?php

if($userid){
    echo "
    <FORM METHOD=\"GET\" ACTION=\"addLocation.php\">
        <button type=\"submit\" class=\"btn btn-primary\">Add a restaurant</button> 
        <input name =\"userid\"value=\"".$userid."\" type=\"hidden\">
    </FORM>";
}

?>
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">A-Z </h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Food Type</th>
            <th>URL</th>
        </tr>
    </thead>
    <tbody>

    <?php
        $query = pg_query($dbcnx, "SELECT * FROM restaurant ORDER BY name");
        $index = 1;

        if (!$query) {
          echo "An error occurred.\n";
          exit;
        }

        while($row = pg_fetch_row($query)){
            echo "<tr>";
            echo "<td>".$index."</td><td><a href=\"details.php?restNo=".$row[3]."&userid=".$id."\">".$row[0]."</a></td><td>".$row[1]."</td><td>";
            if($row[2]){
                echo "<a href=\"".$row[2]."\">Website</a></td>";
            }else{
                echo "</td>";
            }
            
            echo "</tr>";
            $index++;
        }

    ?>
  
    </tbody>   
</table>
</div>



</div>


</body>
</html>

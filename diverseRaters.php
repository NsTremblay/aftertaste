
<?php include("includes/header.php"); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="js/jquery.stickyheader.js"></script>
<link rel="stylesheet" type="text/css" href="css/component.css" />

<body>

<div class="container">
<div class="jumbotron">
<h2 style = "margin-top: -20px; ">Indecisive Raters</h2>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          FlowerPower (justin@gmail.com) - The Works (Burger)
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <table>
            <thead>
                <tr>
                    <th>Rating</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>5/5</td>
                    <td>Perfect</td>

                </tr>
                <tr>
                    <td>4/5</td>
                    <td>Over average</td>

                </tr>
                <tr>
                    <td>3/5</td>
                    <td>Average</td>

                </tr>
                <tr>
                    <td>1/5</td>
                    <td>Disgusting</td>
                </tr>
            </tbody>   
        </table>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Erica (erica@gmail.com) - Starbucks (Mexican)
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <table>
            <thead>
                <tr>
                    <th>Rating</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>5/5</td>
                    <td>Tasty</td>
                </tr>
                <tr>
                    <td>3/5</td>
                    <td>Mehh</td>
                </tr>
                <tr>
                    <td>1/5</td>
                    <td>Gross</td>
                </tr>
            </tbody>   
        </table>
      </div>
    </div>
  </div>
</div>
</div>



</div>


</body>
</html>

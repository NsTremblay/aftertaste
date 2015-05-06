
<?php include("includes/header.php"); ?>
<body>

<div class="container">
<div class="jumbotron">
<h1>Welcome,</h1>
<p>Removed the mambo Jambo Rate and share your Ottawa dining experience with the Aftertaste community. <br> Together we can discover the best restaurants in the nation's capital. </p>
<p><a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#myModal">Sign up</a></p>
</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Register</h4>
      </div>
      <div class="modal-body">
        <form name="addrater" action="add-rater.php" onsubmit="return validateAddRaterForm()" method="post">
        
          <div class="input-group">
            <span class="input-group-addon">Name</span>
            <input id="name" name="name" value="" type="text" class="form-control" placeholder="">
          </div>
      
          <div class="input-group">
            <span class="input-group-addon">Email</span>
            <input id="email" name="email" value="" type="text" class="form-control" placeholder="">
          </div>
       
          <div class="input-group">
            <span class="input-group-addon">Password</span>
            <input id="password" name="password" value="" type="password" class="form-control" placeholder="">
          </div>
            
          <div class="input-group">
            <span class="input-group-addon">Confirm Password</span>
            <input id="confirmPassword" name="confirmPassword" value="" type="password" class="form-control" placeholder="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Ok</button>
      </form>
      </div>
    </div>
  </div>
</div>
    
    
<div class="glyphicon modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">New Rater</h4>
      </div>
      <div class="modal-body">
        <form name="addrater" action="add-rater.php" onsubmit="return validateAddRaterForm()" method="post">
        
          <div class="input-group">
            <span class="input-group-addon">Name</span>
            <input id="name" name="name" value="" type="text" class="form-control" placeholder="">
          </div>
      
          <div class="input-group">
            <span class="input-group-addon">Email</span>
            <input id="email" name="email" value="" type="text" class="form-control" placeholder="">
          </div>
       
          <div class="input-group">
            <span class="input-group-addon">Password</span>
            <input id="password" name="password" value="" type="text" class="form-control" placeholder="">
          </div>
            
          <div class="input-group">
            <span class="input-group-addon">Confirm Password</span>
            <input id="confirmPassword" name="confirmPassword" value="" type="text" class="form-control" placeholder="">
          </div>
            
       </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Ok</button> 
            </div>
        </form>
    </div>
  </div>

</div>    

  

<script type="text/javascript">

function validateAddRaterForm() {

    var message = "";
    
    var name = document.forms["addrater"]["name"].value;
    var email = document.forms["addrater"]["email"].value;
    var password = document.forms["addrater"]["password"].value;
    var confirmPassword = document.forms["addrater"]["confirmPassword"].value;
    
    
    if(message){
    	alert("Les champs obligatoires suivants sont vides: " + message);
        return false;
    }

    else{
    	return true;
    }
}

</script>

    
    
    
</body>
</html>

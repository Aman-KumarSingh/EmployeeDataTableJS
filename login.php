<?php
    include_once "./db_config.php";
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login Form</title>
<link rel="icon" href="https://s3.ap-south-1.amazonaws.com/clouddms.in/clouds__dms.png">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- <script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- <script>$(document).ready(function(c) {
	$('.alert-close').on('click', function(c){
		$('.message').fadeOut('slow', function(c){
	  		$('.message').remove();
		});
	});	  
});
</script> -->
</head>
<body>
<!-- contact-form -->	
<div class="message warning">
<div class="inset">
	<div class="login-head">
		<h1>Login </h1>
		 			
	</div>
		<form method="POST" action="">
			<li>
				<input type="text" class="text" name="username" value="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}" required><a href="#" class=" icon user"></a>
			</li>
				<div class="clear"> </div>
			<li>
				<input type="password" name="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required> <a href="#" class="icon lock"></a>
			</li>
			<div class="clear"> </div>
            <div style="display:none;" id="incorrect" class="alert alert-danger" role="alert">
                Username & Password is incorrect.
                </div>
			<div class="submit">
				<input type="submit"  name="login"value="Sign in" >
                <input type="button" class="btn btn-secondary" style="background-color:#6D4A70;width:120px; height:52px;" onclick="myFunction()" name="signup" value="Register" >
				<!-- <h4><a href="#">Forgot Password ?</a></h4> -->
						  <div class="clear">  </div>	
			</div>
				
		</form>
		</div>					
	</div>
	</div>
	<div class="clear"> </div>
<!--- footer --->
<div class="footer">
	
</div>
<script>
    function myFunction(){
        window.location="register.php";     
    }
</script>
<?php
if(isset($_POST["login"]))
{
  $username=$_POST['username'];
  $username=mysqli_real_escape_string($conn, $username);
  $password=$_POST['password'];
  $password=mysqli_real_escape_string($conn, $password);
    $count=0;
    $res=$conn->query("select * from users where username='$username' && password='$password' ");
    $count=mysqli_num_rows($res);
    if($count==0)
    {
        ?>
        <script type="text/javascript">
        document.getElementById("incorrect").style.display="block";
    </script>
        <?php
    }
    else
    {
        session_start();
      $_SESSION["username"]=$username;
        ?>
         <script type="text/javascript">
             alert("Logged in successfully");
        window.location="dashboard.php";
    </script>
        <?php
    }
}
?>
</body>
</html>
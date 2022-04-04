<?php
    include_once "./db_config.php";
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Register Form</title>
<link rel="icon" href="https://s3.ap-south-1.amazonaws.com/clouddms.in/clouds__dms.png">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<!-- contact-form -->	
<div class="message warning">
<div class="inset">
	<div class="login-head">
		<h1>Registration Form  </h1>
					
	</div>
		<form action="" method="POST">
			<li>
				<input type="text" class="text" name="name" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}"><i class=" far fa-user"></i>
			</li>
            <li>
				<input type="text" class="text" name="username" value="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}"><i class=" fal fa-user"></i>
			</li>
            <li>
				<input type="text" class="text" name="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}"><i class=" far fa-envelope"></i>
			</li>
            <li>
				<input type="number" class="text" maxlength="10" name="contact" placeholder="Contact" value="Contact" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Contact';}"><i class="far fa-phone"></i>
			</li>
				
			<li>
				<input type="password" name="password" value="New Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'New Password';}"> <i class="far fa-lock"></i>
			</li>
            
			<div class="clear"> </div>
			<div class="submit">
                <input type="submit"  name="signup" value="Sign up" >
                <input type="button" class="btn btn-secondary" style="background-color:#6D4A70;width:120px; height:52px;" onclick="myFunction()" name="login" value="Log In" >
				<!-- <h4><a href="#">Forgot Password ?</a></h4> -->
              
					 
                <!-- <div class="clear">  </div>	 -->
			</div>
            <div style="display:none;" id="exists" class="alert alert-danger" role="alert">
            Username or Email id already Exists.
                </div>
            <div class="submit">
            
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
        window.location="login.php";
    }
</script>

<?php
if(isset($_POST["signup"]))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $username=$_POST['username'];
  $username=mysqli_real_escape_string($conn, $username);
  $password=$_POST['password'];
  $password=mysqli_real_escape_string($conn, $password);
  $count=0;
    $res=mysqli_query($conn,"select * from users where username='".$username."' or email='".$email."' ");
    $count=mysqli_num_rows($res);
    if($count>0)
    {
        ?>
        <script type="text/javascript">
       document.getElementById("exists").style.display="block";
    </script>
        <?php
    }
    else
    {
     
    if(mysqli_query($conn,"insert into users values( NULL,'".$name."','".$username."','".$email."','".$contact."','".$password."')") )
    {
       if( mysqli_query($conn,"create table ".$username."(id int not null AUTO_INCREMENT,name varchar(255),email varchar(255),contact varchar(255),primary key(id))")){
        mysqli_query($conn,"insert into users values( NULL,'".$name."','".$email."','".$contact."')");
       }
       else
    {
        ?>
        <script>
            alert('<?php echo mysqli_error($conn); ?>  ');
        </script>
        <?php
    }
        ?>
        <script type="text/javascript">
            alert("Registered Successfully");
        window.location.href="login.php";
    </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert('<?php echo mysqli_error($conn); ?>  ');
        </script>
        <?php
    }
}
}
?>
</body>
</html>
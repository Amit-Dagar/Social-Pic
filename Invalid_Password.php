<?php
	include("Login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.jpg" />
 <meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super Pic - Log In</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h3 class="form-signin-heading" title="Log In to Super Pic Network">Log In to Super Pic</h3><hr />
        
           Invalid Password try again! Choose <a href="Forgot_Password.php">forgotten password?</a><br><br/>
        
        <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Email ID" required="" title="Enter your Email address" />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Your Password" required="" title="Enter your Password"/>
        </div>
       
     	   <div>
			   <a href="Forgot_Password.php">Forgotten password?</a></div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="Login" class="btn btn-default" title="Press Log In button to enter Super Pic Ntwork">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Log In
            </button>
        </div>  
      	<br />
            <label title="Create an account!">Create an account! <a href="sign-up.php" title="Press signup to create new account on Super Pic Network">Sign Up</a></label>

                 </form>

    </div>
    
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>

</body>
</html>
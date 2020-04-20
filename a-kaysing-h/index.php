<?php
if(isset($_POST['Login']))
{
	mysql_connect("localhost","root","Palwal");
	mysql_select_db("faceback");
	
	$u=$_POST['username'];
	$p=$_POST['password'];
	
	$user=($u);
	$pass=($p);
	
	$que_admin_check=mysql_query("select * from admin_info where Username='$user' and Password='$pass'");
	
	$count1=mysql_num_rows($que_admin_check);
	
	if($count1>0)
	{
		session_start();
		$_SESSION['fbadmin']=$user;
		header("location:fb_home/Home.php");
	}
	else
	{
		header("location:../index.php");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.jpg" />
 <meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Social CS - Log In</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h3 class="form-signin-heading" title="Log In to Social CS Network">It's 
		Admin Area.</h3><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Email ID" required="" title="Enter your Email address" />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Your Password" required="" title="Enter your Password"/>
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="Login" class="btn btn-default" value="Log In" title="Press Log In button to enter Social CS Ntwork">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Log In
            </button>
        &nbsp;
            <button class="btn btn-default" name="Login0" style="width: 85px" title="Press Log In button to enter Social CS Ntwork" type="submit">
			<a href="../index.php">Social CS</a></button>
                 
    

                 </div>
&nbsp;</form>

    </div>
    
</div>

</body>
</html>
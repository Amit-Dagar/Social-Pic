<?php
	include("Login.php");
?><?php
	mysql_connect("localhost","root","Palwal");
	mysql_select_db("faceback");
	
	$userid=$_POST['userid'];
	$ans2=$_POST['ans2'];
	
	$que1=mysql_query("select * from user_secret_quotes where user_id=$userid and Answer2='$ans2'");
	$count1=mysql_num_rows($que1);
	
	if($count1>0)
	{
		$que2=mysql_query("select * from users where user_id=$userid");
		$rec1=mysql_fetch_row($que2);
		$password=$rec1[3];
?><?php
	include("Login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="img/Faceback.jpg" rel="SHORTCUT ICON" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Social Pic - Forgot Password Sucess</title>
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.auto-style1 {
	color: #31B0D5;
}
.auto-style2 {
	color: #FFFFFF;
}
</style>
</head>

<body>

<div class="signin-form">
	<div class="container">
		<form id="login-form" class="form-signin" method="post">
			<h4 class="form-signin-heading" title="Your Password is founded.">Your 
			Password is founded.</h4>
			<hr />
			<div id="error">
				<?php
			if(isset($error))
			{
				?>
				<div class="alert alert-danger">
					<i class="glyphicon glyphicon-warning-sign"></i>&nbsp; <?php echo $error; ?>
					! </div>
				<?php
			}
		?>
				<div>
					<h1 style="color: #339900" title="You seccessful to find Your Pasword">
					Success </h1>
					<p style="color: #339900" title="You seccessful to find Your Pasword">&nbsp;</p>
				</div>								<h4>Your Password is:&nbsp;&nbsp;<span class="auto-style1">&nbsp;<?php echo $password; ?></span>
				</h4>
				<p>&nbsp;</p>
			</div>
			<div class="form-group">
            			<a href="index.php">
			<input class="btn btn-primary" style="width: 83px; " title="Press Log In button to enter Social Pic Network" type="button" value="Log In" />
			</a>                 
    

        	</div>
		</form>
	</div>
</div>

</body>

</html>
<?php
	}
	else
	{
		header("location:Forgot_Password.php");
	}
?>
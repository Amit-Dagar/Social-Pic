<?php
	include("Login.php");
?>
<?php
	mysql_connect("localhost","root","Palwal");
	mysql_select_db("faceback");
	
	$userid=$_POST['userid'];
	$ans1=$_POST['ans1'];
	
	$que1=mysql_query("select * from user_secret_quotes where user_id=$userid and Answer1='$ans1'");
	$count1=mysql_num_rows($que1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.jpg" />
 <meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Social Pic- Forgot Password?</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
<link rel="stylesheet" href="style.css" type="text/css"  />
<style>	
		#next
		{
			font-size:18px;
			height:35;
			width:80;
			padding:2;
			background-color:#5B74A8; color:#FFFFFF;
			border-top:#29447E;
			border-right-color:#29447E;
			border-bottom-color:#1A356E;
			border-left-color:#29447E;
			font-size:15px;
			font-weight:bold;
			box-shadow:5px 0px 10px 1px rgb(0,0,0);
		}
	.auto-style1 {
	color: #FFFFFF;
}
	</style>

</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" action="Forgot_Password4.php" method="post" id="login-form">
      
        <input type="hidden" value="<?php echo $userid; ?>" name="userid"/>
      
        <h4 class="form-signin-heading" title="Forgot your Password.">Forgot your Password.</h4><hr />
        
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
        <input type="password" class="form-control" name="ans2" placeholder="Your Answer" required="" title="Enter your Email address" />
        <span id="check-e"></span>
        </div>
        
     	<hr /><?php 
     if($count1>0)
	{
		$que2=mysql_query("select * from user_secret_quotes where user_id=$userid");
		
		$rec1=mysql_fetch_row($que2);
		echo "<div > <h4> Secret Question 2: </h4> </div>";
		echo "<div ><h4>".$rec1[3]."</h4></div>";
?>
        
        <div class="form-group">
            <button type="submit" name="Next" class="btn btn-primary"  title="Press Next button to go to next step of forgotten password">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Next
            </button>
        &nbsp;
            			<a href="index.php">
			<input class="btn btn-primary" style="width: 69px; " title="Press Log In button to enter Social Pic Network" type="button" value="Log In" />
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
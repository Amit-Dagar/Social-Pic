<?php
	session_start();
	if(isset($_SESSION['tempfbuser']))
	{
		mysql_connect("localhost","root","Palwal");
		mysql_select_db("faceback");
		$user=$_SESSION['tempfbuser'];
		$que1=mysql_query("select * from users where Email='$user' ");
		$rec=mysql_fetch_array($que1);
		$userid=$rec[0];
		$gender=$rec[4];
		$que2=mysql_query("select * from user_secret_quotes where user_id=$userid");
		$count1=mysql_num_rows($que2);
		if($count1==0)
		{
		
			$que3=mysql_query("select * from user_profile_pic where user_id=$userid");
			$count3=mysql_num_rows($que3);
			if($count3>0)
			{
?>
<?php
	if(isset($_POST['Next']))
	{
		$que1=$_POST['que'];
		$ans1=$_POST['ans'];

		mysql_query("insert into user_secret_quotes(user_id,Question1,Answer1) values('$userid','$que1','$ans1')");
		header("location:../fb_step3/Secret_Question2.php");
	}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title> Secret Question 1. </title>
<?php
	include("step2_background/background.php");
?>
	<link href="step2_css/step2.css" rel="stylesheet" type="text/css">
    <link href="../../fb_font/font.css" rel="stylesheet" type="text/css">
    <LINK REL="SHORTCUT ICON" HREF="../../fb_title_icon/Faceback.jpg" />
	<script src="step2_js/que_check.js" language="javascript">
	</script>
	<style type="text/css">
	.auto-style1 {
		color: #000080;
	}
	</style>
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.jpg" />
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h3 class="form-signin-heading" title="Secret Question 1:">Secret Question 
		1:</h3><hr />
        <div>
			<p> <img src="img/waiting.gif"></p>
			<p> &nbsp;</p> <h3> Secret Question 1: 
<select name="que" style="height:38;font-size:18px;padding:3; width:250" class="auto-style1">
		<option value="select one">select one</option>
		<option value="what is the first name of your favorite uncle?">What is your "Nick" name? </option>
		<option value="where did you meet you spouse?">What is your "Secret" Code?</option>
		<option value="what is your oldest cousins name?">what is your "Best Flower" name?</option>
		<option value="what is your youngest childs nickname?">What is your "Best Friend" name?</option>
		<option value="what is your oldest childs nickname?">what is your "Nation"?</option>
		<option value="what is the first name of your oldest niece?">what is your "Father" name?</option>
		<option value="what is the first name of your oldest nephew?">what is your "Mother" name?</option>
		<option value="what is the first name of your favorite aunt?">what is your "Child" Name?</option>
		<option value="where did you spend you honeymoon?">where are you "live" ?</option>
</select></h3>
			<h3> Your Answer: <input type="password" name="ans" / style="height:35; width:250; font-size:18px;" maxlength="50"> </h3>
			<p> <input type="submit" name="Next" value="Next" id="Next_button" ></p> </div>
       <form method="post" name="sq" onSubmit="return check()">

<div> </div>
<div>
&nbsp;</div>
<div> </div>

<div> &nbsp;</div>

</form>

<div> &nbsp;</div>

  </form>

    </div>
    
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
		include("step2_erorr/step2_erorr.php");
?>
</body>
</html>
<?php
			}
			else
			{
				if($gender=="Male")
				{
					header("location:../fb_step1/Step1_Male.php");
				}
				else
				{
					header("location:../fb_step1/Step1_Female.php");
				}
			}
		}
		else
		{
			header("location:../fb_step3/Secret_Question2.php");
		}
	}
	else
	{
		header("location:../../../index.php");
	}
?>
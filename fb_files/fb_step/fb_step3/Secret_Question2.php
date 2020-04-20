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
		$que2=mysql_query("select * from user_secret_quotes where user_id=$userid");
		$rec2=mysql_fetch_array($que2);
		$q2=$rec2[3];
		$a2=$rec2[4];
		if($q2=="" && $a2=="")
		{
			$que3=mysql_query("select * from user_secret_quotes where user_id=$userid");
			$count3=mysql_num_rows($que3);
			if($count3>0)
			{
		
?>
<?php
	if(isset($_POST['Finish']))
	{
		$que2=$_POST['que'];
		$ans2=$_POST['ans'];
		
		mysql_query("update user_secret_quotes set Question2='$que2',Answer2='$ans2' where user_id=$userid");
		
		$que_user_data=mysql_query("select * from users where Email='$user';");
		$user_data=mysql_fetch_array($que_user_data);
		$userid=$user_data[0];
		$user_join_time=$user_data[6];
		mysql_query("insert into user_post(user_id,post_txt,post_time,priority) values($userid,'***Join Super Pic***','$user_join_time','Public');");
		mysql_query("insert into user_status values($userid,'Online')");
		mysql_query("insert into user_info(user_id) values($userid)");
		
		session_start();
		$_SESSION['fbuser']=$user;
		header("location:../../fb_home/Home.php");
	}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<?php
	include("step3_background/background.php");
?>
	<link href="step3_css/step3.css" rel="stylesheet" type="text/css">
    <link href="../../fb_font/font.css" rel="stylesheet" type="text/css">
    <LINK REL="SHORTCUT ICON" HREF="../../fb_title_icon/Faceback.jpg" />
	<script src="step3_js/que_check.js" language="javascript">
	</script>
	<style type="text/css">
.auto-style1 {
	color: #000080;
}
</style>
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.jpg" />
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Secret Question - 2.</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h3 class="form-signin-heading" title="Second secret question ">Secret Question 2:</h3><hr />
        
		   <h3> <img src="img/waiting.gif"></h3>
		   <h3> Secret Question 2: 
<select name="que" style="height:38;font-size:18px;padding:3;width:250" class="auto-style1">
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
</select></h3> <h3> Your Answer:  <input type="password" name="ans"  style="height:35; width:250; font-size:18px;" maxlength="50"></h3> 
		   <br> <input type="submit" name="Finish" value="Finish" id="Next_button" ><br>
		   <br><hr />
        
                    <form method="post" name="sq" onSubmit="return check()">


</form>
    </form>

    </div>
    
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
		include("step3_erorr/step3_erorr.php");
?>

</body>
</html>
<?php
			}
			else
			{
				header("location:../fb_step2/Secret_Question1.php");
			}
		}
		else
		{
			header("location:../../fb_home/Home.php");
		}
	}
	else
	{
		header("location:../../../index.php");
	}
?>
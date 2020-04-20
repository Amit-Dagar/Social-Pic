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
		if($gender=="Male")
		{
			$que2=mysql_query("select * from user_profile_pic where user_id=$userid");
			$count1=mysql_num_rows($que2);
			if($count1==0)
			{
?><?php

	if(isset($_POST['file']) && ($_POST['file']=='Upload'))
	{
		$path = "../../../fb_users/Male/".$user."/Profile/";
		$path2 = "../../../fb_users/Male/".$user."/Post/";
		$path3 = "../../../fb_users/Male/".$user."/Cover/";
		mkdir($path, 0, true);
		mkdir($path2, 0, true);
		mkdir($path3, 0, true);
		
		$img_name=$_FILES['file']['name'];
    	$img_tmp_name=$_FILES['file']['tmp_name'];
    	$prod_img_path=$img_name;
    	move_uploaded_file($img_tmp_name,"../../../fb_users/Male/".$user."/Profile/".$prod_img_path);
		
		mysql_query("insert into user_profile_pic(user_id,image) values('$userid','$img_name')");
		header("location:../fb_step2/Secret_Question1.php");
	} 
?>
<html>

<head>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<title>Step1</title>
<link href="step1_css/step1.css" rel="stylesheet" type="text/css">
<link href="../../fb_font/font.css" rel="stylesheet" type="text/css">
<link href="../../fb_title_icon/Faceback.jpg" rel="SHORTCUT ICON" />
<script language="javascript" src="step1_js/Image_check.js">
	</script>
<link href="img/Faceback.jpg" rel="SHORTCUT ICON" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.auto-style1 {
	color: #800000;
}
</style>
</head>

<body>

<?php
include("step1_background/background.php");
?>
<div class="signin-form">
	<div class="container">
		<form id="login-form" class="form-signin" method="post">
			<h3 class="form-signin-heading" title="Step 1st For Profile Editing.">
			Step 1st For Profile Editing. </h3>
			<hr />
			<div>
				<h3>Upload Your Profile Picture </h3>
			</div>
			<br>
			<img src="step1_images/Male.jpg" style="height: 60; width: 60;" title="Your Profile Pic." /><br>
			<div>
				<table>
					<tr>
						<td>&nbsp; </td>
						<td style="text-transform: capitalize; color: Navy" title="Your name is:<?php echo $rec[1]; ?>">
						<h4>(<?php echo $rec[1]; ?>)</h4>
						</td>
					</tr>
				</table>
			</div>
		</form>
		<form enctype="multipart/form-data" method="post" name="uimg" onsubmit="return Img_check();">
			<div  class="form-signin">
				<input id="img" name="file" type="file" /> </div>
			<div id="upload" class="form-signin">
				<input id="upload_button" name="file" type="submit" value="Upload" />
			</div>
		</form>
		<?php
		include("step1_erorr/step1_erorr.php");
	?></div>
</div>

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
			header("location:../fb_step1/Step1_Female.php");
		}
	}
	else
	{
		header("location:../../../index.php");
	}
?>
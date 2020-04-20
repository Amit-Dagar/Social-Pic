<?php
	session_start();
	if(isset($_SESSION['fbuser']))
	{
		include("background.php");
?><?php
	if(isset($_POST['txt']))
	{
		$txt=$_POST['post_txt'];
		$priority=$_POST['priority'];
		$post_time=$_POST['txt_post_time'];
		mysql_query("insert into user_post(user_id,post_txt,post_time,priority) values('$userid','$txt','$post_time','$priority');");
	}
	
	if(isset($_POST['file']) && ($_POST['file']=='post'))
	{
		$txt=$_POST['post_txt'];
		$priority=$_POST['priority'];
		$post_time=$_POST['pic_post_time'];
		if($txt=="")
		{
			$txt="added a new photo.";
		}
		if($gender=="Male")
		{
			$path = "../../fb_users/Male/".$user."/Post/";
		}
		else
		{
			$path = "../../fb_users/Female/".$user."/Post/";
		}
		
		$img_name=$_FILES['file']['name'];
    	$img_tmp_name=$_FILES['file']['tmp_name'];
    	$prod_img_path=$img_name;
		if($gender=="Male")
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Male/".$user."/Post/".$prod_img_path);
		}
		else
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Female/".$user."/Post/".$prod_img_path);
		}
    	mysql_query("insert into user_post(user_id,post_txt,post_pic,post_time,priority) values('$userid','$txt','$img_name','$post_time','$priority');");
	}
	if(isset($_POST['delete_post']))
	{
		$post_id=intval($_POST['post_id']);
		mysql_query("delete from user_post where post_id=$post_id;");
	}
	if(isset($_POST['Like']))
	{
		$post_id=intval($_POST['postid']);
		$user_id=intval($_POST['userid']);
		mysql_query("insert into user_post_status(post_id,user_id,status) values($post_id,$user_id,'Like');");
	}
	if(isset($_POST['Unlike']))
	{
		$post_id=intval($_POST['postid']);
		$user_id=intval($_POST['userid']);
		mysql_query("delete from user_post_status where post_id=$post_id and  	user_id=$user_id;");
	}
	if(isset($_POST['comment']))
	{
		$post_id=intval($_POST['postid']);
		$user_id=intval($_POST['userid']);
		$txt=$_POST['comment_txt'];
		if($txt!="")
		{
		mysql_query("insert into user_post_comment(post_id,user_id,comment) values($post_id,$user_id,'$txt');");
		}
	}
	if(isset($_POST['delete_comment']))
	{
		$comm_id=intval($_POST['comm_id']);
		mysql_query("delete from user_post_comment where comment_id=$comm_id;");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
				<style>
body {
	font-family: "Lato", sans-serif;
}
ul.tab {
	list-style-type: none;
	margin: 0;
	padding: 0;
	overflow: hidden;
	border: 1px solid #ccc;
	background-color: #f1f1f1;
}
/* Float the list items side by side */
ul.tab li {
	float: left;
}
/* Style the links inside the list items */
ul.tab li a {
	display: inline-block;
	color: black;
	text-align: center;
	padding: 14px 16px;
	text-decoration: none;
	transition: 0.3s;
	font-size: 17px;
}
/* Change background color of links on hover */
ul.tab li a:hover {
	background-color: #ddd;
}
/* Create an active/current tablink class */
ul.tab li a:focus, .active {
	background-color: #ccc;
}
/* Style the tab content */
.tabcontent {
	display: none;
	padding: 6px 12px;
	-webkit-animation: fadeEffect 1s;
	animation: fadeEffect 1s;
}
@-webkit-keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
@keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
</style>
				<style>
.loader {
	border: 16px solid #f3f3f3;
	border-radius: 50%;
	border-top: 16px solid blue;
	border-right: 16px solid green;
	border-bottom: 16px solid red;
	width: 120px;
	height: 120px;
	-webkit-animation: spin 2s linear infinite;
	animation: spin 2s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
				<style>
body {
	font-family: "Lato", sans-serif;
}
ul.tab {
	list-style-type: none;
	margin: 0;
	padding: 0;
	overflow: hidden;
	border: 1px solid #ccc;
	background-color: #f1f1f1;
}
/* Float the list items side by side */
ul.tab li {
	float: left;
}
/* Style the links inside the list items */
ul.tab li a {
	display: inline-block;
	color: black;
	text-align: center;
	padding: 14px 16px;
	text-decoration: none;
	transition: 0.3s;
	font-size: 17px;
}
/* Change background color of links on hover */
ul.tab li a:hover {
	background-color: #ddd;
}
/* Create an active/current tablink class */
ul.tab li a:focus, .active {
	background-color: #ccc;
}
/* Style the tab content */
.tabcontent {
	display: none;
	padding: 6px 12px;
	-webkit-animation: fadeEffect 1s;
	animation: fadeEffect 1s;
}
@-webkit-keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
@keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
</style>
				<style>
.loader {
	border: 16px solid #f3f3f3;
	border-radius: 50%;
	border-top: 16px solid blue;
	border-right: 16px solid green;
	border-bottom: 16px solid red;
	width: 120px;
	height: 120px;
	-webkit-animation: spin 2s linear infinite;
	animation: spin 2s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<link href="img/Faceback.jpg" rel="SHORTCUT ICON" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>(<?php echo $name; ?>) Timeline</title>
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="Profile_js/Profile.js"> </script>
<style type="text/css">
.auto-style1 {
	color: #800000;
}
</style>
</head>

<body>

<script>
	function time_get()
	{
			d = new Date();
			mon = d.getMonth()+1;
			time = d.getDate()+"-"+mon+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes();
			posting_txt.txt_post_time.value=time;
	}
	function time_get1()
	{
		d = new Date();
		mon = d.getMonth()+1;
		time = d.getDate()+"-"+mon+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes();
		posting_pic1.pic_post_time.value=time;
	}
</script>
<div class="signin-form">
	<div class="container">
		<form id="login-form" class="form-signin" method="post">
			<h3 class="form-signin-heading"><span class="auto-style1" style="color:#800000"><a href="timeline.php">
			<span class="auto-style1">Timeline</span></a></span> <?php
	$que_post_img=mysql_query("select * from user_post where user_id=$userid and post_pic!='' order by post_id desc");
	$photos_count=mysql_num_rows($que_post_img);
	$photos_count=$photos_count+$count1+1;
?>| <a href="about.php" style="color: #800000;">About</a> |&nbsp;<a href="photos.php" style="color: #800000">Photos </a>(<?php echo $photos_count; ?>)</h3>
			<p></p>
			<div class="form-signin">
				<style>
body {
	font-family: "Lato", sans-serif;
}
ul.tab {
	list-style-type: none;
	margin: 0;
	padding: 0;
	overflow: hidden;
	border: 1px solid #ccc;
	background-color: #f1f1f1;
}
/* Float the list items side by side */
ul.tab li {
	float: left;
}
/* Style the links inside the list items */
ul.tab li a {
	display: inline-block;
	color: black;
	text-align: center;
	padding: 14px 16px;
	text-decoration: none;
	transition: 0.3s;
	font-size: 17px;
}
/* Change background color of links on hover */
ul.tab li a:hover {
	background-color: #ddd;
}
/* Create an active/current tablink class */
ul.tab li a:focus, .active {
	background-color: #ccc;
}
/* Style the tab content */
.tabcontent {
	display: none;
	padding: 6px 12px;
	-webkit-animation: fadeEffect 1s;
	animation: fadeEffect 1s;
}
@-webkit-keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
@keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
</style>
				<ul class="tab" style="height: 48px">
					<li style="height: 39px">
					<a class="tablinks" href="../fb_home/Home.php" onclick="openCity(event, 'Home')">
					<span style="color: blue">Home</span></a></li>
					<li style="height: 39px">
					<a class="tablinks" href="photos.php" onclick="openCity(event, 'My account')">
					<span style="color: blue">My account</span></a></li>
					<li style="height: 39px">
					<a class="tablinks" href="Profile_picture.php" onclick="openCity(event, 'Profile')">
					<span style="color: blue">Profile</span></a></li>
					<li style="height: 39px">
					<a class="tablinks" href="../fb_home/feedback.php" onclick="openCity(event, 'feedback')">
					<span style="color: blue">feedback</span></a></li>
					<li style="height: 39px">
					<a class="tablinks" href="../fb_logout/logout.php" onclick="openCity(event, 'Logout?')">
					<span style="color: blue">Logout?</span></a></li>
					<li style="height: 39px">
					<a class="tablinks" href="../fb_home/Settings.php" onclick="openCity(event, 'Settings')">
					<span style="color: blue">Account Settings</span></a></li>
				</ul>
				<style>
.loader {
	border: 16px solid #f3f3f3;
	border-radius: 50%;
	border-top: 16px solid blue;
	border-right: 16px solid green;
	border-bottom: 16px solid red;
	width: 120px;
	height: 120px;
	-webkit-animation: spin 2s linear infinite;
	animation: spin 2s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
				<div id="Home" class="tabcontent">
					<h3>Home</h3>
					<div class="loader">
					</div>
					<p>Loading Please wait....</p>
				</div>
				<div id="My account" class="tabcontent">
					<h3>My account</h3>
					<div class="loader">
					</div>
					<p>Loading Please wait....</p>
				</div>
				<div id="Profile" class="tabcontent">
					<h3>Profile</h3>
					<div class="loader">
					</div>
					<p>Loading Please wait....</p>
				</div>
				<div id="feedback" class="tabcontent">
					<h3>feedback</h3>
					<div class="loader">
					</div>
					<p>Loading Please wait....</p>
				</div>
				<div id="Logout?" class="tabcontent">
					<h3>Logout?</h3>
					<div class="loader">
					</div>
					<p>Loading Please wait....</p>
				</div>
				<div id="Settings" class="tabcontent">
					<h3>Account Settings</h3>
					<div class="loader">
					</div>
					<p>Loading Please wait....</p>
				</div>
				<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
			</form>
<form id="post_txt" class="form-signin" method="post" name="posting_txt" onsubmit="return blank_post_check();">
	<div>
		<div title="Welcome To Timeline." class="auto-style2">
		<span class="auto-style3">&nbsp;(<?php echo $name; ?>)</span> update your 
		status and post a&nbsp;new story.</div>
		<br><img src="img/Status.PNG"><input onclick="upload_close();" style="background: #FFFFFF; border: #FFFFFF;" type="button" value="Update Status"><img src="img/photo&video.PNG"><input class="auto-style1" name="file1" onclick="upload_open();" style="background: #FFFFFF; border: #FFFFFF;" type="button" value="Add  Photos"></div>
	<div>
		<textarea maxlength="511" name="post_txt" placeholder="What's on your mind?" style="height: 157px; width: 777px;"></textarea>
		<input name="txt_post_time" type="hidden"><br></div>
	<div>
		<select name="priority" style="background: transparent; border-bottom: 5px;">
		<option value="Public">Public</option>
		<option value="Private">Only me</option>
		</select>
		<input id="post_button" name="txt" onclick="time_get()" type="submit" value="post"><br>
		<br></div>
</form>
<div>
</div>
<div>
	<form id="post_pic" class="form-signin" enctype="multipart/form-data" method="post" name="posting_pic" onsubmit="return Img_check();" style="display: none;">
		<div title="Welcome To Timeline." class="auto-style2">
		<span class="auto-style3">&nbsp;(<?php echo $name; ?>)</span> update your 
		status and post a&nbsp;new story.</div><br>

		<div>
			<img src="img/Status.PNG"><input onclick="upload_close();" style="background: #FFFFFF; border: #FFFFFF;" type="button" value="Update Status"><img src="img/photo&video.PNG"><input class="auto-style1" name="file1" onclick="upload_open();" style="background: #FFFFFF; border: #FFFFFF;" type="button" value="+Add Photos"></div>
		<div>
			<textarea maxlength="511" name="post_txt" placeholder="What's on your mind?" style="height: 157px; width: 777px;"></textarea>
		</div>
		<input name="pic_post_time" type="hidden">
		<div>
			<select name="priority" style="background: transparent; border-bottom: 5px;">
			<option value="Public">Public</option>
			<option value="Private">Only me</option>
			</select> </div>
		<div>
			<input id="img" name="file" type="file"><input id="post_button" name="file" onclick="time_get1()" type="submit" value="post">
		</div>
	</form>
</div>
					<div><table class="form-signin" cellspacing="0" style="height: 2208px">
						<?php
	$que_post=mysql_query("select * from user_post where user_id=$userid order by post_id desc");
	while($post_data=mysql_fetch_array($que_post))
	{
		$postid=$post_data[0];
		$post_user_id=$post_data[1];
		$post_txt=$post_data[2];
		$post_img=$post_data[3];
		$que_user_info=mysql_query("select * from users where user_id=$post_user_id");
		$que_user_pic=mysql_query("select * from user_profile_pic where user_id=$post_user_id");
		$fetch_user_info=mysql_fetch_array($que_user_info);
		$fetch_user_pic=mysql_fetch_array($que_user_pic);
		$user_name=$fetch_user_info[1];
		$user_Email=$fetch_user_info[2];
		$user_gender=$fetch_user_info[4];
		$user_pic=$fetch_user_pic[2];
?>
						<tr>
							<?php
			if($post_txt=="***join Social Pic***")
			{?>
							<td align="right" colspan="5" style="border-top: outset; border-top-width: thin;">&nbsp;
							</td>
							<td></td>
							<td></td>
							<?php
			}
			else
			{
			?>
							<td align="right" colspan="5" style="border-top: outset; border-top-width: thin;">
							<form method="post">
								<input name="post_id" type="hidden" value="<?php echo $postid; ?>" />
							</form>
							</td>
							<td></td>
							<td></td>
							<?php } ?>
						</tr>
						<tr>
							<td rowspan="2" style="padding-left: 10;" width="5%">
							<img height="60" src="../../fb_users/<?php echo $user_gender; ?>/<?php echo $user_Email; ?>/Profile/<?php echo $user_pic; ?>" width="55" />
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="3" style="padding: 7;">
							<a id="uname<?php echo $postid; ?>" href="#" onmouseout="post_name_NounderLine(<?php echo $postid; ?>)" onmouseover="post_name_underLine(<?php echo $postid; ?>)" style="text-transform: capitalize; text-decoration: none; color: #003399;">
							<?php echo $user_name; ?></a></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
	$len=strlen($post_data[2]);
	if($len>0 && $len<=73)
	{
		$line1=substr($post_data[2],0,73);
	?>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?>
							</td>
						</tr>
						<?php
	}
	else if($len>73 && $len<=146)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
	?>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?>
							</td>
						</tr>
						<?php
	}
	else if($len>146 && $len<=219)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
	?>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?>
							</td>
						</tr>
						<?php
	}
	else if($len>219 && $len<=292)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
		$line4=substr($post_data[2],219,73);
	?>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line4; ?>
							</td>
						</tr>
						<?php
	}
	else if($len>292 && $len<=365)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
		$line4=substr($post_data[2],219,73);
		$line5=substr($post_data[2],292,73);
	?>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line4; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line5; ?>
							</td>
						</tr>
						<?php
	}
	else if($len>365 && $len<=438)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
		$line4=substr($post_data[2],219,73);
		$line5=substr($post_data[2],292,73);
		$line6=substr($post_data[2],365,73);
	?>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line4; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line5; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line6; ?>
							</td>
						</tr>
						<?php
	}
	else if($len>438 && $len<=511)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
		$line4=substr($post_data[2],219,73);
		$line5=substr($post_data[2],292,73);
		$line6=substr($post_data[2],365,73);
		$line7=substr($post_data[2],438,73);
	?>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line4; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line5; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line6; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="padding-left: 7;"><?php echo $line7; ?>
							</td>
						</tr>
						<?php
}
?><?php 
		if($post_data[3]!="")
		{
	?>
						<tr>
							<td></td>
							<td colspan="3">
							<img height="400" src="../../fb_users/<?php echo $user_gender; ?>/<?php echo $user_Email; ?>/Post/<?php echo $post_img; ?>" style="box-shadow: 0px 0px 5px 1px rgb(0,0,0);" width="400" />
							</td>
							<td></td>
							<td></td>
						</tr>
						<?php
		}
	?>
						<tr style="color: #6D84C4;">
							<td></td>
							<?php
		 	$que_status=mysql_query("select * from user_post_status where post_id=$postid and user_id=$userid;");
			$que_like=mysql_query("select * from user_post_status where post_id=$postid");
			$count_like=mysql_num_rows($que_like);
			$status_data=mysql_fetch_array($que_status);
			if($status_data[3]=="Like")
			{?>
							<td style="padding-top: 15;">
							<form method="post">
								<input name="postid" type="hidden" value="<?php echo $postid; ?>" />
								<input name="userid" type="hidden" value="<?php echo $userid; ?>" />
								<img src="img/like.PNG" />(<?php echo $count_like; ?>)<input id="unlike<?php echo $postid; ?>" name="Unlike" onmouseout="unlike_NounderLine(<?php echo $postid; ?>)" onmouseover="unlike_underLine(<?php echo $postid; ?>)" style="border: #FFFFFF; background: #FFFFFF; font-size: 15px; color: #6D84C4;" type="submit" value="Unlike" /></form></td>
							<?php
			}
			else
			{?>
							<td style="padding-top: 15;">
							<form method="post">
								<input name="postid" type="hidden" value="<?php echo $postid; ?>" />
								<input name="userid" type="hidden" value="<?php echo $userid; ?>" />
								<img src="img/like.PNG" />(<?php echo $count_like; ?>)&nbsp;
								<input id="like<?php echo $postid; ?>" name="Like" onmouseout="like_NounderLine(<?php echo $postid; ?>)" onmouseover="like_underLine(<?php echo $postid; ?>)" style="border: #FFFFFF; font-size: 15px; color: #6D84C4;" type="submit" value="Like" /></form></td>
							<?php
			}
		 ?><?php
		 
		 	$que_comment=mysql_query("select * from user_post_comment where post_id =$postid order by comment_id");
	$count_comment=mysql_num_rows($que_comment);
		 ?>
							<td colspan="3">&nbsp;
							<input id="comment<?php echo $postid; ?>" onclick="Comment_focus(<?php echo $postid; ?>);" onmouseout="Comment_NounderLine(<?php echo $postid; ?>)" onmouseover="Comment_underLine(<?php echo $postid; ?>)" style="background: #FFFFFF; border: #FFFFFF; font-size: 15px; color: #6D84C4;" type="button" value="Comment(<?php echo $count_comment; ?>)"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span style="color: #999999;"><?php echo $post_data[4]; ?>
							</span></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
	while($comment_data=mysql_fetch_array($que_comment))
	{
		$comment_id=$comment_data[0];
		$comment_user_id=$comment_data[2];
		$que_user_info1=mysql_query("select * from users where user_id=$comment_user_id");
		$que_user_pic1=mysql_query("select * from user_profile_pic where user_id=$comment_user_id");
		$fetch_user_info1=mysql_fetch_array($que_user_info1);
		$fetch_user_pic1=mysql_fetch_array($que_user_pic1);
		$user_name1=$fetch_user_info1[1];
		$user_Email1=$fetch_user_info1[2];
		$user_gender1=$fetch_user_info1[4];
		$user_pic1=$fetch_user_pic1[2];
?>
						<tr>
							<td></td>
							<td rowspan="2" style="padding-left: 12;" width="4%">
							<img height="40" src="../../fb_users/<?php echo $user_gender1; ?>/<?php echo $user_Email1; ?>/Profile/<?php echo $user_pic1; ?>" width="47" />
							</td>
							<td bgcolor="#EDEFF4" style="padding-left: 7;">
							<a id="cuname<?php echo $comment_id; ?>" href="#" onmouseout="Comment_name_NounderLine(<?php echo $comment_id; ?>)" onmouseover="Comment_name_underLine(<?php echo $comment_id; ?>)" style="text-transform: capitalize; text-decoration: none; color: #3B5998;">
							<?php echo $user_name1; ?></a></td>
							<td align="right" bgcolor="#EDEFF4" rowspan="2">
							<form method="post">
								<input name="comm_id" type="hidden" value="<?php echo $comment_id; ?>" />
								<input name="delete_comment" style="background-color: #FFFFFF; border: #FFFFFF; background-image: url(img/delete_comment.gif); width: 13; height: 13;" type="submit" value="  " /> &nbsp;
							</form>
							</td>
						</tr>
						<?php
	$clen=strlen($comment_data[3]);
	if($clen>0 && $clen<=60)
	{
		$cline1=substr($comment_data[3],0,60);
	?>
						<tr>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?>
							</td>
						</tr>
						<?php
	}
	else if($clen>60 && $clen<=120)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
	?>
						<tr>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?>
							</td>
						</tr>
						<?php
	}
	else if($clen>120 && $clen<=180)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
	?>
						<tr>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?>
							</td>
						</tr>
						<?php
	}
	else if($clen>180 && $clen<=240)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
		$cline4=substr($comment_data[3],180,60);
	?>
						<tr>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline4; ?>
							</td>
						</tr>
						<?php
	}
	else if($clen>240 && $clen<=300)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
		$cline4=substr($comment_data[3],180,60);
		$cline5=substr($comment_data[3],240,60);
	?>
						<tr>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline4; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline5; ?>
							</td>
						</tr>
						<?php
	}
	else if($clen>300 && $clen<=360)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
		$cline4=substr($comment_data[3],180,60);
		$cline5=substr($comment_data[3],240,60);
		$cline6=substr($comment_data[3],300,60);
	?>
						<tr>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline4; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline5; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline6; ?>
							</td>
						</tr>
						<?php
	}
	else if($clen>360 && $clen<=420)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
		$cline4=substr($comment_data[3],180,60);
		$cline5=substr($comment_data[3],240,60);
		$cline6=substr($comment_data[3],300,60);
		$cline7=substr($comment_data[3],360,60);
	?>
						<tr>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline4; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline5; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline6; ?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2" style="padding-left: 7;"><?php echo $cline7; ?>
							</td>
						</tr>
						<?php
	}
	?><?php
}
?>
						<tr>
							<td></td>
							<td rowspan="2" style="padding-left: 17;" width="4%">
							<img src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Profile/<?php echo $img; ?>" style="height: 33; width: 33;" />
							</td>
							<td colspan="2" style="padding-top: 15;">
							<form method="post" name="commenting" onsubmit="return blank_comment_check()">
								<input id="<?php echo $postid;?>" maxlength="420" name="comment_txt" placeholder="Write a comment..." style="width: 440;" type="text" />
								<input name="postid" type="hidden" value="<?php echo $postid; ?>" />
								<input name="userid" type="hidden" value="<?php echo $userid; ?>" />
								<input name="comment" style="display: none;" type="submit" />
							</form>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
	}
?>
					</table>
					<div class="form-signin">
						<style>
body {font-family: "Lato", sans-serif;}

ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Float the list items side by side */
ul.tab li {float: left;}

/* Style the links inside the list items */
ul.tab li a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.tab li a:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    -webkit-animation: fadeEffect 1s;
    animation: fadeEffect 1s;
}

@-webkit-keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
						</style>

<ul class="tab" style="height: 48px">
  <li style="height: 39px"><a href="../fb_home/Home.php" class="tablinks" onclick="openCity(event, 'Home')"><span style="color: blue">Home</span></a></li>
  <li style="height: 39px"><a href="photos.php" class="tablinks" onclick="openCity(event, 'My account')"><span style="color: blue">My account</span></a></li>
  <li style="height: 39px"><a href="Profile_picture.php" class="tablinks" onclick="openCity(event, 'Profile')"><span style="color: blue">Profile</span></a></li>
  <li style="height: 39px"><a href="../fb_home/feedback.php" class="tablinks" onclick="openCity(event, 'feedback')"><span style="color: blue">feedback</span></a></li>
  <li style="height: 39px"><a href="../fb_logout/logout.php" class="tablinks" onclick="openCity(event, 'Logout?')"><span style="color: blue">Logout?</span></a></li>
  <li style="height: 39px"><a href="../fb_home/Settings.php" class="tablinks" onclick="openCity(event, 'Settings')"><span style="color: blue">Account Settings</span></a></li>
</ul>
<style>

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.auto-style1 {
	color: #800000;
}
.auto-style2 {
	color: #5E5E5E;
}
</style>

<div id="Home" class="tabcontent">
  <h3>Home</h3>
  <div class="loader"></div>
  <p>Loading Please wait....</p>
</div>

<div id="My account" class="tabcontent">
  <h3>My account</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p> 
</div>

<div id="Profile" class="tabcontent">
  <h3>Profile</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>
<div id="feedback" class="tabcontent">
  <h3>feedback</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>

<div id="Logout?" class="tabcontent">
  <h3>Logout?</h3>
  <div class="loader"></div>
<p>Loading Please wait....</p> 
</div>

<div id="Settings" class="tabcontent">
  <h3>Account Settings</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>


<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
</div>
</div>
				</div>
			</div>
		</form>
				
</body>

</html>
<?php
	}
	else
	{
		header("location:../../index.php");
	}
?>
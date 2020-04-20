<?php
	session_start();
	if(isset($_SESSION['fbuser']))
	{
		include("background.php");
?><?php
	if(isset($_POST['delete_warning']))
	{
		$user_warning_id=intval($_POST['warning_id']);
		mysql_query("delete from user_warning where user_id=$user_warning_id;");
	}
	if(isset($_POST['delete_notice']))
	{
		$n_id=intval($_POST['notice_id']);
		mysql_query("delete from users_notice where notice_id=$n_id;");
	}
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
			$txt="Added a new photo.";
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
<html>

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
<link href="img/Faceback.jpg" rel="SHORTCUT ICON" />
<title>Welcome - <?php echo $name; ?></title>
<link href="Home_css/Home.css" rel="stylesheet" type="text/css">
<script language="javascript" src="Home_js/home.js"></script>
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
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.auto-style1 {
	color: #800000;
}
.auto-style2 {
	color: #000080;
}
</style>
</head>

<body>

<div class="form-signin">
	<div>
		<?php
	$que_warning=mysql_query("select * from user_warning where user_id=$userid");
	$warning_count=mysql_num_rows($que_warning);
	if($warning_count>0)
	{
		$warning_data=mysql_fetch_array($que_warning);
		$warning_txt=$warning_data[1];
?>
		<div style="z-index: 3;">
			<img height="100" src="img/Warning_icon.png" width="100"></div>
		<div style="z-index: 3; color: #971111; font-size: 72px;">
			warning </div>
		<div style="color: Navy; font-size: 20px; z-index: 3;">
			Message:- <?php echo $warning_txt; ?></div>
		<form method="post">
			<input name="warning_id" type="hidden" value="<?php echo $userid; ?>">
			<div style="z-index: 3;">
				<input id="accept_button" name="delete_warning" type="submit" value="I accept Warning">
			</div>
		</form>
	</div>
</div>
<div class="form-signin">
	<?php	
	}
?><?php
	$que_notice=mysql_query("select * from users_notice where user_id=$userid");
	$notice_count=mysql_num_rows($que_notice);
	if($notice_count>0)
	{
		$notice_data=mysql_fetch_array($que_notice);
		$notice_id=$notice_data[0];
		$notice_txt=$notice_data[2];
		$notice_time=$notice_data[3];
?>
	<div style="z-index: 3;">
		<img height="100" src="img/Notice.png" width="100"></div>
	<div style="z-index: 3; color: #3B59A4; font-size: 48px;">
		Notice </div>
	<div style="font-size: 20px; z-index: 3; color: Navy">
		Message:- <?php echo $notice_txt; ?></div>
	<div style="font-size: 20px; color: #999999; z-index: 3;">
		Notice Time: <?php echo $notice_time; ?></div>
	<form method="post">
		<input name="notice_id" type="hidden" value="<?php echo $notice_id; ?>">
		<div style="left: 62%; top: 83%; z-index: 3;">
			<input id="accept_button" name="delete_notice" type="submit" value="I accept Notice">
		</div>
	</form>
</div>
<?php	
	}
?>
<form id="login-form" class="form-signin" method="post">
	<section id="articles">
	<article id="article1">
		<h4></h4>
		<ul class="tab">
			<li>
			<a class="tablinks" href="home.php" onclick="openCity(event, 'Home')">
			<span style="color: blue">Home</span></a></li>
			<li>
			<a class="tablinks" href="../fb_profile/photos.php" onclick="openCity(event, 'My account')">
			<span style="color: blue">My account</span></a></li>
			<li>
			<a class="tablinks" href="../fb_profile/Profile_picture.php" onclick="openCity(event, 'Profile')">
			<span style="color: blue">Profile</span></a></li>
			<li>
			<a class="tablinks" href="feedback.php" onclick="openCity(event, 'feedback')">
			<span style="color: blue">feedback</span></a></li>
			<li>
			<a class="tablinks" href="../fb_logout/logout.php" onclick="openCity(event, 'Logout?')">
			<span style="color: blue">Logout?</span></a></li>
			<li>
			<a class="tablinks" href="Settings.php" onclick="openCity(event, 'Settings')">
			<span style="color: blue">Account Setting</span></a></li>
		</ul>
	</article>
	</section>
	<ul>
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
	-webkit-animation: spin 0.5s linear infinite;
	animation: spin 0.5s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.auto-style3 {
	color: #FF0000;
}
</style>
	<div id="Home" class="tabcontent">
		<h3>Home</h3>
		<div class="loader">
		</div>
		<p>Loading Please....</p>
	</div>
	<div id="My account" class="tabcontent">
		<h3>My account!</h3>
		<div class="loader">
		</div>
		<p>Loading Please wait....</p>
	</div>
	<div id="Profile" class="tabcontent">
		<h3>Profile</h3>
		<div class="loader">
		</div>
		<p>Loding Please wait....</p>
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
		<p>Loding Please wait....</p>
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
		<h4 class="form-signin-heading" title="Welcome To Super Pic.">
		<span class="auto-style3">&nbsp;(<?php echo $name; ?>)</span><span class="auto-style4"> update your 
		status and post a&nbsp;new story.</span></h4>
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
		<h4 class="form-signin-heading" title="Welcome To Super Pic.">
		<span class="auto-style3">&nbsp;(<?php echo $name; ?>)</span><span class="auto-style4"> update your 
		status and post a&nbsp;new story.</span></h4>

		<br><div>
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
<table cellspacing="0" class="form-signin">
	<?php
	$que_post=mysql_query("select * from user_post where priority='Public' order by post_id desc");
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
?><?php
		if($userid==$post_user_id)
		{ ?>
	<tr>
		<?php
			if($post_txt=="***Join Super Pic.***")
			{?><?php
			}
			else
			{
			?>
		<td align="right" style="border-top: outset; border-top-width: thin;">
		<form method="post">
			<input name="post_id" type="hidden" value="<?php echo $postid; ?>" />
		</form>
		</td>
	</tr>
	<?php
		}
		}
		else
		{ ?>
	<tr>
		<td align="right" colspan="4" style="border-top: outset; border-top-width: thin;">
		</td>
	</tr>
	<?php	
		}
	?>
	<tr>
		<td rowspan="2" style="padding-left: 25;" width="5%">
		<img height="60" src="../../fb_users/<?php echo $user_gender; ?>/<?php echo $user_Email; ?>/Profile/<?php echo $user_pic; ?>" width="55" />
		</td>
	</tr>
	<tr>
		<td colspan="3" style="padding: 7;">
		<a id="uname<?php echo $postid; ?>" href="../fb_profile/photos.php?id=<?php echo $post_user_id; ?>" onmouseout="post_name_NounderLine(<?php echo $postid; ?>)" onmouseover="post_name_underLine(<?php echo $postid; ?>)" style="text-transform: capitalize; text-decoration: none; color: navy;">
		<?php echo $user_name; ?></a></td>
	</tr>
	<?php
	$len=strlen($post_data[2]);
	if($len>0 && $len<=73)
	{
		$line1=substr($post_data[2],0,73);
	?>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7; color: gray;">Status:-
		<span style="color: #800000"><?php echo $line1; ?></span></td>
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
		<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?></td>
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
		<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?></td>
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
		<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line4; ?></td>
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
		<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line4; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line5; ?></td>
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
		<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line4; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line5; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line6; ?></td>
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
		<td colspan="3" style="padding-left: 7;"><?php echo $line1; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line2; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line3; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line4; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line5; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line6; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left: 7;"><?php echo $line7; ?></td>
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
		<img height="400" src="../../fb_users/<?php echo $user_gender; ?>/<?php echo $user_Email; ?>/Post/<?php echo $post_img; ?>" style="box-shadow: 0px 0px 5px 1px rgb(0,0,0);" width="380" />
		</td>
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
		<td style="padding-top: 15; width: 11%;">
		<form method="post">
			<input name="postid" type="hidden" value="<?php echo $postid; ?>" />
			<input name="userid" type="hidden" value="<?php echo $userid; ?>" />
			<img src="img/like.PNG" /><span style="color: #6D84C4;">(<?php echo $count_like; ?>)</span>&nbsp;&nbsp;
			<input id="unlike<?php echo $postid; ?>" name="Unlike" onmouseout="unlike_NounderLine(<?php echo $postid; ?>)" onmouseover="unlike_underLine(<?php echo $postid; ?>)" style="border: #FFFFFF; background: #FFFFFF; font-size: 15px; color: #6D84C4;" type="submit" value="Unlike" /></form>
		</td>
		<?php
			}
			else
			{?>
		<td style="padding-top: 15; width: 294px;">
		<form method="post">
			<input name="postid" type="hidden" value="<?php echo $postid; ?>" />
			<input name="userid" type="hidden" value="<?php echo $userid; ?>" />
			<img src="img/like.PNG" />(<?php echo $count_like; ?>)<input id="like<?php echo $postid; ?>" name="Like" onmouseout="like_NounderLine(<?php echo $postid; ?>)" onmouseover="like_underLine(<?php echo $postid; ?>)" style="border: #FFFFFF; background: #FFFFFF; font-size: 15px; color: #6D84C4;" type="submit" value="Like" /></form>
		</td>
		<?php
			}
		 ?><?php
		 
		 	$que_comment=mysql_query("select * from user_post_comment where post_id =$postid order by comment_id");
	$count_comment=mysql_num_rows($que_comment);
		 ?>
		<td>&nbsp;
		<input id="comment<?php echo $postid; ?>" onclick="Comment_focus(<?php echo $postid; ?>);" onmouseout="Comment_NounderLine(<?php echo $postid; ?>)" onmouseover="Comment_underLine(<?php echo $postid; ?>)" style="background: #FFFFFF; border: #FFFFFF; font-size: 15px; color: #6D84C4;" type="button" value="Comment(<?php echo $count_comment; ?>)" />
		<span style="color: #800000;">&nbsp;</span>
		
		</td>
		
	</tr>
	<tr>
&nbsp;
	</tr>
	<tr>
		<td style="">Comments </td>
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
		<td style="padding-left: 12;" width="4%">
		<img height="40" src="../../fb_users/<?php echo $user_gender1; ?>/<?php echo $user_Email1; ?>/Profile/<?php echo $user_pic1; ?>" width="47" />
		</td>
		<td style="padding-left: 8; width: 11%;">
		<a id="cuname<?php echo $comment_id; ?>" href="../fb_view_profile/view_profile.php?id=<?php echo $comment_user_id; ?>" onmouseout="Comment_name_NounderLine(<?php echo $comment_id; ?>)" onmouseover="Comment_name_underLine(<?php echo $comment_id; ?>)" style="text-transform: capitalize; text-decoration: none; color: #800000;">
		(<?php echo $user_name1; ?>)</a> </td>
		<?php
		if($userid==$post_user_id)
		{ ?>
		<td align="right" style="width: 294px">
		<form method="post">
			<input name="comm_id" type="hidden" value="<?php echo $comment_id; ?>" />
			<input name="delete_comment" style="background-color: #FFFFFF; border: #FFFFFF; background-image: url(img/delete_comment.gif); width: 13; height: 13;" type="submit" value="  " /> &nbsp;
		</form>
		</td>
		<?php
		}
		else if($userid==$comment_user_id)
		{ ?>
		<td align="right">
		<form method="post">
			<input name="comm_id" type="hidden" value="<?php echo $comment_id; ?>" />
			<input name="delete_comment" style="background-color: #FFFFFF; border: #FFFFFF; background-image: url(img/delete_comment.gif); width: 13; height: 13;" type="submit" value="  " /> &nbsp;
		</form>
		</td>
		<?php
		}
		else
		{?><?php
		}
	?>
	</tr>
	<?php
	$clen=strlen($comment_data[3]);
	if($clen>0 && $clen<=60)
	{
		$cline1=substr($comment_data[3],0,60);
	?>
	<tr>
		<td></td>
		<td class="auto-style2" color="Navy" colspan="2" style="padding-left: 7;">
		Comment:-<?php echo $cline1; ?></td>
	</tr>
	<br />
	<br />
	<?php
	}
	else if($clen>60 && $clen<=120)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
	?>
	<tr>
		<td></td>
		<td class="auto-style2" colspan="2" style="padding-left: 7;">Comment:-<?php echo $cline1; ?></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td colspan="1" style="padding-left: 7; width: 294px;">&nbsp;</td>
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
		<td colspan="1" style="padding-left: 7; width: 11%;"><?php echo $cline1; ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td colspan="1" style="padding-left: 7; width: 294px;"><?php echo $cline2; ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?></td>
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
		<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline4; ?></td>
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
		<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline4; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline5; ?></td>
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
		<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline4; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline5; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline6; ?></td>
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
		<td colspan="2" style="padding-left: 7;"><?php echo $cline1; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline2; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline3; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline4; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline5; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline6; ?></td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 7;"><?php echo $cline7; ?></td>
	</tr>
	<?php
	}
	?><?php
	}
	?>
	<tr>
		<td>&nbsp;</td>
		<td rowspan="2" style="padding-left: 17; width: 11%;">
		&nbsp;<img src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Profile/<?php echo $img; ?>" style="height: 33; width: 33;" /></td><td bgcolor="" colspan="1" style="padding-top: 15;">
		<form method="post" name="commenting" onsubmit="return blank_comment_check()" style="width: 324px">
			<input id="<?php echo $postid;?>" maxlength="420" name="comment_txt" placeholder="Write a comment..." style="width: 320; height: 44px;" type="text" />
			<input name="postid" type="hidden" value="<?php echo $postid; ?>" />
			<input name="userid" type="hidden" value="<?php echo $userid; ?>" />
			<input name="comment" style="display: none;" type="submit" />
		</form>
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"><hr><br>For went to TOP:<ul>
                        <li><a href="#article1">Top</a></li>
						<hr>
</ul></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px">&nbsp;</td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="width: 11%"></td>
		<td style="width: 294px"></td>
		<td></td>
	</tr>
	<?php } ?>
</table>
<br />
<div>
	<div>
		<a href="../fb_home/feedback.php">&nbsp;</a></div>
	<div>
	</div>
	<div class="form-signin" style="">
		<h4 class="form-signin-heading" title="Welcome To Super Pic.">Settings</h4>
		<a id="head_logout" href="../fb_logout/logout.php" onmouseout="head_logout_out()" onmouseover="head_logout_over()" style="text-decoration: none; color: #000;">
		<hr>
		</a>
		</a>
		<div>
<form id="login-form0" class="form-signin" method="post">
	<section id="articles0">
	<article id="article2">
		<h4></h4>
		<ul class="tab">
			<li>
			<a class="tablinks" href="home.php" onclick="openCity(event, 'Home')">
			<span style="color: blue">Home</span></a></li>
			<li>
			<a class="tablinks" href="../fb_profile/photos.php" onclick="openCity(event, 'My account')">
			<span style="color: blue">My account</span></a></li>
			<li>
			<a class="tablinks" href="../fb_profile/Profile_picture.php" onclick="openCity(event, 'Profile')">
			<span style="color: blue">Profile</span></a></li>
			<li>
			<a class="tablinks" href="feedback.php" onclick="openCity(event, 'feedback')">
			<span style="color: blue">feedback</span></a></li>
			<li>
			<a class="tablinks" href="../fb_logout/logout.php" onclick="openCity(event, 'Logout?')">
			<span style="color: blue">Logout?</span></a></li>
			<li>
			<a class="tablinks" href="Settings.php" onclick="openCity(event, 'Settings')">
			<span style="color: blue">Account Setting</span></a></li>
		</ul>
	</article>
	</section>
	<style>
.loader {
	border: 16px solid #f3f3f3;
	border-radius: 50%;
	border-top: 16px solid blue;
	border-right: 16px solid green;
	border-bottom: 16px solid red;
	width: 120px;
	height: 120px;
	-webkit-animation: spin 0.5s linear infinite;
	animation: spin 0.5s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.auto-style3 {
	color: #FF0000;
}
	.auto-style4 {
		color: #808080;
	}
	</style>
	<div id="Home0" class="tabcontent">
		<h3>Home</h3>
		<div class="loader">
		</div>
		<p>Loading Please....</p>
	</div>
	<div id="My account0" class="tabcontent">
		<h3>My account!</h3>
		<div class="loader">
		</div>
		<p>Loading Please wait....</p>
	</div>
	<div id="Profile0" class="tabcontent">
		<h3>Profile</h3>
		<div class="loader">
		</div>
		<p>Loding Please wait....</p>
	</div>
	<div id="feedback0" class="tabcontent">
		<h3>feedback</h3>
		<div class="loader">
		</div>
		<p>Loading Please wait....</p>
	</div>
	<div id="Logout?0" class="tabcontent">
		<h3>Logout?</h3>
		<div class="loader">
		</div>
		<p>Loding Please wait....</p>
	</div>
	<div id="Settings0" class="tabcontent">
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
			<br>
			<a id="head_logout0" href="../fb_logout/logout.php" onmouseout="head_logout_out()" onmouseover="head_logout_over()" style="text-decoration: none; color: #000;">
			<hr></a></a></div>
	</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
		include("Home_error/Home_error.php");
	?>

</body>

</html>
<?php
	}
	else
	{
		header("location:../../index.php");
	}
?>
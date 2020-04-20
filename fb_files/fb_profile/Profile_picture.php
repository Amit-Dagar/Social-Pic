<?php
	session_start();
	if(isset($_SESSION['fbuser']))
?><?php
		$user=$_SESSION['fbuser'];
		mysql_connect("localhost","root","Palwal");
		mysql_select_db("faceback");
		$query1=mysql_query("select * from users where Email='$user'");
		$rec1=mysql_fetch_array($query1);
		$userid=$rec1[0];
		$query2=mysql_query("select * from user_profile_pic where user_id=$userid");
		$rec2=mysql_fetch_array($query2);
		
		$name=$rec1[1];
		$gender=$rec1[4];
		$user_bday=$rec1[5];
		$img=$rec2[2];
?><?php
if(isset($_POST['file']) && ($_POST['file']=='Upload'))
{
		if($gender=="Male")
		{
			$path = "../../fb_users/Male/".$user."/Profile/";
		}
		else
		{
			$path = "../../fb_users/Female/".$user."/Profile/";
		}
		
		$img_name=$_FILES['file']['name'];
    	$img_tmp_name=$_FILES['file']['tmp_name'];
    	$prod_img_path=$img_name;
		if($gender=="Male")
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Male/".$user."/Profile/".$prod_img_path);
		}
		else
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Female/".$user."/Profile/".$prod_img_path);
		}
    	mysql_query("update user_profile_pic set image='$img_name' where user_id=$userid;");
		header("location:Profile_picture.php");
}

if(isset($_POST['file1']) && ($_POST['file1']=='Upload'))
{
		if($gender=="Male")
		{
			$path = "../../fb_users/Male/".$user."/Cover/";
		}
		else
		{
			$path = "../../fb_users/Female/".$user."/Cover/";
		}
		
		$img_name=$_FILES['file1']['name'];
    	$img_tmp_name=$_FILES['file1']['tmp_name'];
    	$prod_img_path=$img_name;
		if($gender=="Male")
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Male/".$user."/Cover/".$prod_img_path);
		}
		else
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Female/".$user."/Cover/".$prod_img_path);
		}
    	mysql_query("insert into user_cover_pic(user_id,image) values('$userid','$img_name');");
		header("location:Profile_picture.php");
}

if(isset($_POST['file2']) && ($_POST['file2']=='Upload'))
{
		if($gender=="Male")
		{
			$path = "../../fb_users/Male/".$user."/Cover/";
		}
		else
		{
			$path = "../../fb_users/Female/".$user."/Cover/";
		}
		
		$img_name=$_FILES['file2']['name'];
    	$img_tmp_name=$_FILES['file2']['tmp_name'];
    	$prod_img_path=$img_name;
		if($gender=="Male")
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Male/".$user."/Cover/".$prod_img_path);
		}
		else
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Female/".$user."/Cover/".$prod_img_path);
		}
		mysql_query("update user_cover_pic set image='$img_name' where user_id=$userid;");
		header("location:Profile_picture.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<link href="img/Faceback.jpg" rel="SHORTCUT ICON" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Super Pic - <?php echo $name ?></title>
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="background_file/background_js/event.js"></script>
<script src="background_file/background_js/searching.js"></script>
<script src="background_file/background_js/searched_reco_event.js"></script>
<script src="background_file/background_js/profile_pic&cover_pic.js"></script>
</head>

<body>

<div class="signin-form">
	<div class="container">
		<form id="login-form" class="form-signin" method="post">
			<h3 class="form-signin-heading" title="Log In to Super Pic Network">
			Profile Picture Settings.</h3>
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
			<hr>
			<!--Profile pic ,name-->
			<div>
				<table border="0">
					<tr>
						<td>
						<img onclick="open_profile_photo()" onmouseout="out_pro_pic_edit();" onmouseover="dis_pro_pic_edit();" src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Profile/<?php echo $img; ?>" style="height: 125px; width: 125px" />
						</td>
						<td>&nbsp; &nbsp;
						<a id="left_name" href="../fb_profile/Profile_picture.php" onmouseout="left_name_out()" onmouseover="left_name_over()" style="color: #800000; font-size: 16; font-weight: 900; font-family: lucida Bright; text-transform: capitalize; text-decoration: none; background-color: white;">
						(<?php echo $name; ?>)</a></td>
					</tr>
				</table>
			</div>
		</form>
		<form class="form-signin" enctype="multipart/form-data" method="post" name="posting_pic" onsubmit="return profile_Img_check();">
			<div>
				<input id="img1" name="file" type="file" /> </div>
			<div>
				<input id="upload_button" name="file" type="submit" value="Upload" /><br>
				<br><hr/>
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
				<br>
				<hr></div>
		</form>
		</form>
	</div>
</div>
<p>&nbsp;</p>

</body>

</html>
